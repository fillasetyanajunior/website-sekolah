<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Extracurricular;
use App\Models\Grade;
use App\Models\StudentDetail;
use App\Models\Subject;
use App\Models\TeacherDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class FinalReportController extends AppController
{
    public function index()
    {
        $title      = 'Cetak Raport';
        $teacher    = TeacherDetail::find(Auth::user()->id_guru);
        if ($teacher->wali_kelas == 'X') {
            $student = StudentDetail::orderBy('nama')->where('kelas', $teacher->wali_kelas)->where('no_kelas', $teacher->wali_no_kelas)->paginate(20);
        } else {
            $student = StudentDetail::orderBy('nama')->where('kelas', $teacher->wali_kelas)->where('jurusan', $teacher->wali_jurusan)->paginate(20);
        }
        return view('teacher.finalreport.finalreport', compact('title', 'student'));
    }

    public function print(Request $request)
    {
        $request->only('id');
        $id             = Crypt::decrypt($request->id);
        $grades         = Grade::where('id_siswa', $id)->first();
        $grade          = Grade::where('id_siswa', $id)->get();
        $student        = StudentDetail::find($id);
        $extra          = Extracurricular::where('id_siswa', $id)->get();
        $sakit          = Attendance::where('keterangan', 'Sakit')->where('id_siswa', $id)->count();
        $izin           = Attendance::where('keterangan', 'Izin')->where('id_siswa', $id)->count();
        $tanpaket       = Attendance::where('keterangan', 'Tanpa Keterangan')->where('id_siswa', $id)->count();
        return view('teacher.finalreport.print_finalreport', compact('grade', 'student', 'extra', 'sakit', 'izin', 'tanpaket', 'grades'));
    }
}
