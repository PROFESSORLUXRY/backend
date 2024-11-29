<?php

namespace App\Http\Controllers;

use App\Models\CounterUrl;

class CounterUrlController extends Controller
{
    public function index()
    {
        return view('pages.counter_url.index');
    }

    public function getItems()
    {
        return datatables(CounterUrl::with(['machine'])->get())->toJson();
    }
}
