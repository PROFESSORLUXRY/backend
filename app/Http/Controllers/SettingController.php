<?php

namespace App\Http\Controllers;

use App\Models\Command;
use App\Models\Machine;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        return view('pages.settings.index');
    }

    public function save(Request $r)
    {
        $post = $r->all();

        foreach ($post as $key => $value) {
            $s = Setting::query()->where('name', $key)->first();

            if ($key === 'grabber_urls' || $key === "counter_urls") {
                $value = explode(',', $value);
                $value = json_encode($value);
            }

            if ($s) {
                $s->update([
                    'value' => $value
                ]);
            } else {
                Setting::create([
                    'name' => $key,
                    'value' => $value
                ]);
            }
        }

        $machines = Machine::all();

        foreach ($machines as $machine) {
            Command::query()->create([
                'machine_id' => $machine->id,
                'command' => json_encode([
                    'cmd' => 'settings',
                    'uuid' => $machine->uuid,
                    'data' => []
                ])
            ]);
        }

        return redirect()->route('settings');
    }
}
