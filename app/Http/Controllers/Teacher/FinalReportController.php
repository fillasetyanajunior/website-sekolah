<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Extracurricular;
use App\Models\Grade;
use App\Models\StudentDetail;
use App\Models\TeacherDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class FinalReportController extends AppController
{
    public function index()
    {
        $title      = 'Raport';
        $teacher    = TeacherDetail::find(Auth::user()->id_guru);
        $student    = StudentDetail::orderBy('nama')->where('kelas', $teacher->wali_kelas)->where('jurusan', $teacher->wali_jurusan)->paginate(20);
        return view('teacher.finalreport.finalreport', compact('title', 'student'));
    }

    public function print(Request $request)
    {
        $request->only('id');
        $id         = Crypt::decrypt($request->id);
        $grade      = Grade::where('id_siswa',$id)->get();
        $student    = StudentDetail::find($id);
        $extra      = Extracurricular::where('id_siswa', $id)->get();
        return view('teacher.finalreport.print_finalreport',compact('grade', 'student', 'extra'));
    }
}
