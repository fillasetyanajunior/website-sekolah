<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Exam;
use App\Models\StudentDetail;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;

class ExamController extends AppController
{
    public function index()
    {
        $title      = 'Jadwal Ujian Akhir';
        $exam       = Exam::paginate(20);
        $subject    = Subject::all();
        $department = Department::all();
        return view('admin.exam.exam', compact('title','exam','subject','department'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal'       => 'required',
            'jam'           => 'required',
            'matapelajaran' => 'required',
            'jurusan'       => 'required',
            'tipe_ujian'    => 'required',
        ]);

        if ($request->tipe_ujian == 1) {
            $tipe = 'Tertulis';
        } else {
            $tipe = 'Praktikum';
        }

        Exam::create([
            'tanggal'       => $request->tanggal,
            'jam'           => $request->jam,
            'matapelajaran' => Subject::where('matapelajaran', $request->matapelajaran)->first()->id,
            'jurusan'       => Department::where('jurusan', $request->jurusan)->first()->id,
            'tipe_ujian'    => $tipe,
        ]);
        return redirect()->back()->with('success', 'Data Berhasil Ditambahkan');
    }

    public function edit(Request $request)
    {
        $exam = Exam::find(Crypt::decrypt($request->exam));
        return response()->json([
            'tanggal'       => $exam->tanggal,
            'jam'           => $exam->jam,
            'matapelajaran' => Subject::where('matapelajaran', $exam->matapelajaran)->first()->id,
            'jurusan'       => Department::where('jurusan', $exam->jurusan)->first()->id,
            'tipe_ujian'    => $exam->tipe_ujian,
        ]);
    }

    public function update(Request $request, Exam $exam)
    {
        if ($request->tipe_ujian == 1) {
            $tipe = 'Tertulis';
        } else {
            $tipe = 'Praktikum';
        }

        Exam::where('id', Crypt::decrypt($request->exam))
            ->update([
            'tanggal'       => $request->tanggal,
            'jam'           => $request->jam,
            'matapelajaran' => Subject::where('matapelajaran', $request->matapelajaran)->first()->id,
            'jurusan'       => Department::where('jurusan', $request->jurusan)->first()->id,
            'tipe_ujian'    => $tipe,
        ]);
        return redirect()->back()->with('success', 'Data Berhasil Update');
    }

    public function destroy(Request $request)
    {
        Exam::destroy(Crypt::decrypt($request->exam));
        return redirect()->back()->with('success', 'Data Berhasil Delete');
    }
}
