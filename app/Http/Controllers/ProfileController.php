<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function settings()
    {
        return view('pages.profile.settings');
    }

    public function saveSettings(Request $r)
    {
        $user = Auth::user();

        $currentPassword = $r->post('currentPassword');
        $newPassword = $r->post('newPassword');
        $confirmPassword = $r->post('confirmPassword');

        if (!Hash::check($currentPassword, $user->password)) {
            return redirect()->back()->withErrors([
                'msg' => 'Current password does not match'
            ]);
        }

        if ($newPassword !== $confirmPassword) {
            return redirect()->back()->withErrors([
                'msg' => 'New password does not match'
            ]);
        }

        $user->update([
            'password' => Hash::make($newPassword)
        ]);

        return redirect()->back();
    }
}
