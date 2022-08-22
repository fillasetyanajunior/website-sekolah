<?php

namespace App\Http\Controllers\Auth\Teacher;

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
        if (Auth::guard('teacher')->check()) {
            return redirect(route('teacher.dashboard'));
        }
        $title = 'Login';
        return view('teacher.auth.login', compact('title'));
    }

    public function login(Request $request)
    {
        $request->validate([
            'username'     => 'required',
            'password'  => 'required',
        ]);

        $credentials = ['username' => $request->username, 'password' => $request->password];

        if (Auth::guard('teacher')->attempt($credentials))
            return redirect()->route('teacher.dashboard');

        return redirect()->route('teacher.login.form')->with(['error' => "Kata sandi dan username tidak cocok"]);
    }
}
