<?php

namespace App\Http\Controllers\Auth\Counselingguidance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('throttle:6,1')->only('login');
    }

    public function form()
    {
        if (Auth::guard('counseling')->check()) {
            return redirect(route('counseling.dashboard'));
        }
        $title = 'Login';
        return view('counselingguidance.auth.login', compact('title'));
    }

    public function login(Request $request)
    {
        $request->validate([
            'username'  => 'required',
            'password'  => 'required',
        ]);

        $credentials = ['username' => $request->username, 'password' => $request->password];

        if (Auth::guard('counseling')->attempt($credentials))
            return redirect()->route('counseling.dashboard');

        return redirect()->route('counseling.login.form')->with(['error' => "Kata sandi dan username tidak cocok"]);
    }
}
