<?php

namespace App\Http\Controllers;

use App\Models\Grabber;
use Illuminate\Http\Request;

class GrabberController extends Controller
{
    public function index()
    {
        return view('pages.grabber.index');
    }

    public function getItems()
    {
        return datatables(Grabber::with(['machine'])->get())->toJson();
    }
}
