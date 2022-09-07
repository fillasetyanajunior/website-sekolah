<?php

namespace App\Http\Controllers\Auth\Learning\Teacher;

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
        if (Auth::guard('teacher_learning')->check()) {
            return redirect(route('learning.teacher.dashboard'));
        }
        $title = 'Login';
        return view('teacher.learning.auth.login', compact('title'));
    }

    public function login(Request $request)
    {
        $request->validate([
            'username'  => 'required',
            'password'  => 'required',
        ]);

        $credentials = ['username' => $request->username, 'password' => $request->password];

        if (Auth::guard('teacher_learning')->attempt($credentials))
            return redirect()->route('learning.teacher.dashboard');

        return redirect()->route('learning.teacher.login.form')->with(['error' => "Kata sandi dan username tidak cocok"]);
    }
}
