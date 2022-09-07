<?php

namespace App\Http\Controllers\Auth\Learning\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function logout(Request $request)
    {
        Auth::guard('teacher_learning')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('learning.teacher.login.form')->with(['error' => 'Anda berhasil logout']);
    }
}
