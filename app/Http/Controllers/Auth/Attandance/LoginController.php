<?php

namespace App\Http\Controllers\Auth\Attandance;

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
        if (Auth::guard('app')->check()) {
            return redirect(route('attandance.splash'));
        }
        $title = 'Login';
        return view('attandance.login', compact('title'));
    }

    public function login(Request $request)
    {
        $request->validate([
            'username'  => 'required',
            'password'  => 'required',
        ]);

        $credentials = ['username' => $request->username, 'password' => $request->password];

        if (Auth::guard('app')->attempt($credentials))
            return redirect()->route('attandance.splash');

        return redirect()->route('attandance.login.form')->with(['error' => "Kata sandi dan username tidak cocok"]);
    }
}
