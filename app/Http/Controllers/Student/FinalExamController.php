<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\StudentDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FinalExamController extends AppController
{
    public function index()
    {
        $title              = 'Ujian Akhir';
        $student            = StudentDetail::find(Auth::user()->id_siswa);
        $practicalexam      = Exam::where('jurusan', $student->jurusan)->where('tipe_ujian', 'Traktikum')->get();
        $writtenexamination = Exam::where('jurusan', $student->jurusan)->where('tipe_ujian', 'Tertulis')->get();
        return view('student.ujian.ujian', compact('title', 'writtenexamination', 'practicalexam'));
    }
}
