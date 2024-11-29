<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function index()
    {
        return view('pages.addresses.index');
    }

    public function getItems()
    {
        $items = Address::all();

        foreach ($items as $item) {
            $item->edit_url = route('addresses.info', ['id' => $item->id]);
            $item->remove_url = route('addresses.remove', ['id' => $item->id]);
        }

        return datatables($items)->toJson();
    }

    public function getItem($id = null)
    {
        if (!$id) {
            return view('pages.addresses.item');
        }

        $item = Address::query()->where('id', $id)->first();

        if (!$item) {
            return redirect()->back();
        }

        return view('pages.addresses.item', compact('item'));
    }

    public function removeItem($id)
    {
        $item = Address::query()->where('id', $id)->first();

        if (!$item) {
            return redirect()->back();
        }

        $item->forceDelete();

        return redirect()->back();
    }

    public function createOrEditItem(Request $r)
    {
        $data = $r->all();

        if ($r->post('id')) {
            $data['type'] = 'BTC';

            Address::where('id', $r->post('id'))->update($data);
        } else {
            $addresses = preg_split('/\n|\r\n?/', $data['address']);

            foreach ($addresses as $address) {
                Address::create([
                    'type' => 'BTC',
                    'address' => $address
                ]);
            }
        }

        return redirect()->route('addresses');
    }
}
