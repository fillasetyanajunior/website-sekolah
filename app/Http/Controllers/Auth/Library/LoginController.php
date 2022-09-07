<?php

namespace App\Http\Controllers\Auth\Library;

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
        if (Auth::guard('library')->check()) {
            return redirect(route('library.dashboard'));
        }
        $title = 'Login';
        return view('library.auth.login', compact('title'));
    }

    public function login(Request $request)
    {
        $request->validate([
            'username'  => 'required',
            'password'  => 'required',
        ]);

        $credentials = ['username' => $request->username, 'password' => $request->password];

        if (Auth::guard('library')->attempt($credentials))
            return redirect()->route('library.dashboard');

        return redirect()->route('library.login.form')->with(['error' => "Kata sandi dan username tidak cocok"]);
    }
}
