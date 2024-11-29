<?php

namespace App\Http\Controllers;

use App\Models\Extension;

class ExtensionController extends Controller
{
    public function index()
    {
        return view('pages.extension.index');
    }

    public function getItems()
    {
        return datatables(Extension::with(['machine'])->get())->toJson();
    }
}
