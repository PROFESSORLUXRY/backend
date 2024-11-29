<?php

namespace App\Http\Controllers;

use App\Models\Account;

class AccountController extends Controller
{
    public function index()
    {
        return view('pages.accounts.index');
    }

    public function getItems()
    {
        $items = Account::all();

        foreach ($items as $item) {
            $item->balance = number_format($item->balance, 2);
            $item->remove_url = route('accounts.remove', ['id' => $item->id]);

            if ($item->machine_id) {
                $item->machine_url = route('machines.info', ['id' => $item->machine_id]);
            }

            $balancesText = '';
            $balances = json_decode($item->all_balances, true);

            foreach ($balances as $balance) {
                $balancesText .= $balance['asset'] . ' - ' . number_format($balance['usd'], 2) . '$ (' . $balance['type'] . ') | ';
            }

            $item->all_balances = $balancesText;
            $item->country = $item->country ?? 'N/A';
        }

        return datatables($items)->toJson();
    }

    public function removeItem($id)
    {
        $item = Account::query()->where('id', $id)->first();

        if (!$item) {
            return redirect()->back();
        }

        $item->forceDelete();

        return redirect()->back();
    }
}
