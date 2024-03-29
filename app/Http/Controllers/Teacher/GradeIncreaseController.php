<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\StudentDetail;
use App\Models\TeacherDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class GradeIncreaseController extends AppController
{
    public function index()
    {
        $title      = 'Kenaikan Kelas';
        $teacher    = TeacherDetail::find(Auth::user()->id_guru);
        $student    = StudentDetail::orderBy('nama')->where('kelas', $teacher->wali_kelas)->where('jurusan', $teacher->wali_jurusan)->paginate(20);
        return view('teacher.gradeincrease.gradeincrease', compact('title', 'student'));
    }

    public function update(Request $request)
    {
        if ($request->kelas == 1) {
            $kelas = 'X';
        } elseif ($request->kelas == 2) {
            $kelas = 'XI';
        } else {
            $kelas = 'XII';
        }

        StudentDetail::where('id', Crypt::decrypt($request->studentDetail))
                    ->update([
                        'kelas' => $kelas
                    ]);

        return redirect()->back()->with('success', 'Data Berhasil di ubah');
    }

    public function update_all(Request $request)
    {
        if ($request->kelas == 1) {
            $kelas = 'X';
        } elseif ($request->kelas == 2) {
            $kelas = 'XI';
        } else {
            $kelas = 'XII';
        }

        $teacher = TeacherDetail::find(Auth::user()->id_guru);

        StudentDetail::where('kelas', $teacher->wali_kelas)->where('jurusan', $teacher->wali_jurusan)
                    ->update([
                        'kelas' => $kelas
                    ]);

        return redirect()->back()->with('success', 'Semua Data Berhasil di ubah');
    }
}
