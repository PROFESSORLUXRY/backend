<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function loginAction(Request $request)
    {
        $data = $request->all();

        $user = User::query()->where([['name', $data['username']]])->first();

        if (!$user) {
            return redirect()->back();
        }

        if (!Hash::check($data['password'], $user->password)) {
            return redirect()->back();
        }

        Auth::login($user, true);

        return redirect()->route('index');
    }

    public function logoutAction()
    {
        Auth::logout();

        return redirect()->route('index');
    }
}
