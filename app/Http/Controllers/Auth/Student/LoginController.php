<?php

namespace App\Http\Controllers\Auth\Student;

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
        if (Auth::guard('student')->check()) {
            return redirect(route('student.dashboard'));
        }
        $title = 'Login';
        return view('student.auth.login', compact('title'));
    }

    public function login(Request $request)
    {
        $request->validate([
            'username'     => 'required',
            'password'  => 'required',
        ]);

        $credentials = ['username' => $request->username, 'password' => $request->password];

        if (Auth::guard('student')->attempt($credentials))
            return redirect()->route('student.dashboard');

        return redirect()->route('student.login.form')->with(['error' => "Kata sandi dan username tidak cocok"]);
    }
}
