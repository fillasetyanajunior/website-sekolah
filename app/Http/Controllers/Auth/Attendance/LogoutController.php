<?php

namespace App\Http\Controllers\Auth\Attendance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function logout(Request $request)
    {
        Auth::guard('app')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('attendance.login.form'))->with(['error' => 'Anda berhasil logout']);
    }
}
