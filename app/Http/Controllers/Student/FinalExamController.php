<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FinalExamController extends Controller
{
    public function index()
    {
        $title              = 'Ujian Akhir';
        $practicalexam      = Exam::where('id_siswa', Auth::user()->id_siswa)->where('tipe_ujian', 'praktikum')->get();
        $writtenexamination = Exam::where('id_siswa', Auth::user()->id_siswa)->where('tipe_ujian', 'tertulis')->get();
        return view('student.ujian.ujian', compact('title', 'writtenexamination', 'practicalexam'));
    }
}
