<?php

namespace App\Http\Controllers\Auth\Admin;

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
        if (Auth::guard('admin')->check()) {
            return redirect(route('admin.dashboard'));
        }
        $title = 'Login';
        return view('admin.auth.login', compact('title'));
    }

    public function login(Request $request)
    {
        $request->validate([
            'username'  => 'required',
            'password'  => 'required',
        ]);

        $credentials = ['username' => $request->username, 'password' => $request->password];

        if (Auth::guard('admin')->attempt($credentials))
            return redirect()->route('admin.dashboard');

        return redirect()->route('admin.login.form')->with(['error' => "Kata sandi dan username tidak cocok"]);
    }
}
