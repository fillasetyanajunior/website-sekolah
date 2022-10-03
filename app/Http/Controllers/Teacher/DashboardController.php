<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Schedule;
use App\Models\TeacherDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends AppController
{
    public function index()
    {
        $title      = 'Dashboard';
        $schedule   = Schedule::orderBy('hari')->orderBy('kelas')->where('guru', Auth::user()->id_guru)->get();
        $classroom  = Classroom::where('id_guru', Auth::user()->id_guru)->get();
        return view('teacher.dashboard', compact('title', 'schedule', 'classroom'));
    }
    public function profile()
    {
        $title = 'Profile';
        $teacher = TeacherDetail::find(Auth::user()->id_guru);
        return view('teacher.profile', compact('title','teacher'));
    }
}
