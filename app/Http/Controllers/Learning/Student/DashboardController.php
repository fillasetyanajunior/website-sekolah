<?php

namespace App\Http\Controllers\Learning\Student;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\StudentDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends AppController
{
    public function index()
    {
        $title      = 'Dashboard';
        $student    = StudentDetail::find(Auth::user()->id_siswa);
        if ($student->kelas == 'X') {
            $class = Classroom::where('no_kelas', $student->no_kelas)->where('kelas', $student->kelas)->get();
        } else {
            $class = Classroom::where('jurusan', $student->jurusan)->where('kelas', $student->kelas)->get();
        }

        return view('student.learning.dashboard' ,compact('title', 'class'));
    }
}
