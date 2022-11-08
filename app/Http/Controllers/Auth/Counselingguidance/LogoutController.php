<?php

namespace App\Http\Controllers\Auth\Counselingguidance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function logout(Request $request)
    {
        Auth::guard('counsling')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('counsling.login.form'))->with(['error' => 'Anda berhasil logout']);
    }
}
