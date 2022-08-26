<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Deuteronomi;
use App\Models\Schedule;
use App\Models\StudentDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends AppController
{
    public function index()
    {
        $title          = 'Dashboard';
        $student        = StudentDetail::find(Auth::user()->id_siswa);
        $schedule       = Schedule::where('kelas', $student->kelas)->where('jurusan', $student->jurusan)->get();
        $deuteronomi    = Deuteronomi::where('id_siswa', Auth::user()->id_siswa)->get();
        return view('student.dashboard', compact('title', 'deuteronomi', 'schedule'));
    }
}
