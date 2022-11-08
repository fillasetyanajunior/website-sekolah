<?php

namespace App\Http\Controllers\Counselingguidance;

use App\Http\Controllers\Controller;
use App\Models\Offance;
use App\Models\StudentDetail;
use App\Models\StudentOffance;
use App\Models\TeacherDetail;
use Illuminate\Http\Request;

class OffenseController extends AppController
{
    public function index()
    {
        $title          = 'Input Pelanggaran';
        $offensestudent = StudentOffance::paginate(30);
        $offense        = Offance::all();
        $student        = StudentDetail::all();
        $teacher        = TeacherDetail::all();
        return view('counselingguidance.offense.offense', compact('title', 'offensestudent', 'offense', 'student', 'teacher'));
    }
}
