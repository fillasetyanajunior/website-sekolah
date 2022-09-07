<?php

namespace App\Http\Controllers\Auth\Learning\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function logout(Request $request)
    {
        Auth::guard('student_learning')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('learning.student.login.form')->with(['error' => 'Anda berhasil logout']);
    }
}
