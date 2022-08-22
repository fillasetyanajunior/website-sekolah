<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GradeController extends AppController
{
    public function index()
    {
        $title = 'Nilai';
        $grade = Grade::where('nama', Auth::user()->name)->get();
        return view('student,nilai.nilai', compact('title', 'grade'));
    }
}
