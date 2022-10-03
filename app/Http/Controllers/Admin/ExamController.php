<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Exam;
use App\Models\StudentDetail;
use App\Models\Subject;
use Illuminate\Http\Request;
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
            'matapelajaran' => $request->matapelajaran,
            'jurusan'       => $request->jurusan,
            'tipe_ujian'    => $tipe,
        ]);
        return redirect()->back()->with('success', 'Data Berhasil Ditambahkan');
    }

    public function edit(Exam $exam)
    {
        return response()->json($exam);
    }

    public function update(Request $request, Exam $exam)
    {
        if ($request->tipe_ujian == 1) {
            $tipe = 'Tertulis';
        } else {
            $tipe = 'Praktikum';
        }

        Exam::where('id', $exam->id)
            ->update([
            'tanggal'       => $request->tanggal,
            'jam'           => $request->jam,
            'matapelajaran' => $request->matapelajaran,
            'jurusan'       => $request->jurusan,
            'tipe_ujian'    => $tipe,
        ]);
        return redirect()->back()->with('success', 'Data Berhasil Update');
    }

    public function destroy(Exam $exam)
    {
        Exam::destroy($exam->id);
        return redirect()->back()->with('success', 'Data Berhasil Delete');
    }
}
