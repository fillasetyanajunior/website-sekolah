<?php

namespace App\Http\Controllers\Auth\Attendance;

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
            return redirect(route('attendance.splash'));
        }
        $title = 'Login';
        return view('attendance.login', compact('title'));
    }

    public function login(Request $request)
    {
        $request->validate([
            'username'  => 'required',
            'password'  => 'required',
        ]);

        $credentials = ['username' => $request->username, 'password' => $request->password];

        if (Auth::guard('app')->attempt($credentials))
            return redirect()->route('attendance.splash');

        return redirect()->route('attendance.login.form')->with(['error' => "Kata sandi dan username tidak cocok"]);
    }
}
