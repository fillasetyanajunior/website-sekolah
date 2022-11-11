<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Department;
use App\Models\StudentDetail;
use App\Models\Subject;
use App\Models\TeacherDetail;
use App\Models\Teaching;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ClassroomController extends AppController
{
    public function index()
    {
        $title      = 'Ruang Kelas';
        $classroom  = Classroom::orderBy('no_kelas')->orderBy('jurusan')->paginate(30);
        $no_kelas   = StudentDetail::groupBy('no_kelas')->having('no_kelas', '!=', 'null')->get('no_kelas');
        $department = Department::all();
        $subject    = Subject::all();
        $teacher    = TeacherDetail::all();
        return view('admin.classroom.classroom', compact('title', 'classroom', 'no_kelas', 'department', 'subject', 'teacher'));
    }

    public function store(Request $request)
    {
        if ($request->kelas == 1) {
            $kelas = 'X';
        } elseif ($request->kelas == 2) {
            $kelas = 'XI';
        } else {
            $kelas = 'XII';
        }

        $teaching = Teaching::where('kelas', $kelas)->get();

        if ($request->kelas == 1) {
            foreach ($teaching as $showteaching) {
                Classroom::create([
                    'id_guru'   => TeacherDetail::where('nama', $showteaching->id_guru)->first()->id,
                    'nama'      => Subject::where('matapelajaran', $showteaching->matapelajaran)->first()->id,
                    'no_kelas'  => $showteaching->no_kelas,
                    'kelas'     => $showteaching->kelas,
                ]);
            }
        } else {
            foreach ($teaching as $showteaching) {
                Classroom::create([
                    'id_guru'   => TeacherDetail::where('nama', $showteaching->id_guru)->first()->id,
                    'nama'      => Subject::where('matapelajaran', $showteaching->matapelajaran)->first()->id,
                    'jurusan'   => Department::where('jurusan', $showteaching->jurusan)->first()->id,
                    'kelas'     => $showteaching->kelas,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Data Berhasil Ditambahkan');
    }

    public function edit(Request $request)
    {
        $classroom = Classroom::find(Crypt::decrypt($request->classroom));
        return response()->json([
            'nama'      => $classroom->nama,
            'jurusan'   => Department::find($classroom->jurusan)->jurusan,
            'kelas'     => $classroom->kelas,
            'no_kelas'  => $classroom->no_kelas,
            'id_guru'   => TeacherDetail::find($classroom->id_guru)->nama,
        ]);
    }

    public function update(Request $request)
    {
        $classroom = Classroom::find(Crypt::decrypt($request->classroom));
        if ($classroom->kelas == 1) {
            Classroom::where('id', $classroom->id)
                    ->update([
                        'id_guru'   => $request->id_guru,
                        'nama'      => $request->matapelajaran,
                        'no_kelas'  => $request->no_kelas,
                        'kelas'     => $request->kelas,
                    ]);
        } else {
            Classroom::where('id', $classroom->id)
                    ->update([
                        'id_guru'   => $request->id_guru,
                        'nama'      => $request->matapelajaran,
                        'jurusan'   => $request->jurusan,
                        'kelas'     => $request->kelas,
                    ]);
        }
        return redirect()->back()->with('success', 'Data Berhasil Diubah');
    }

    public function destroy(Request $request)
    {
        Classroom::destroy(Crypt::decrypt($request->classroom));
        return redirect()->back()->with('success', 'Data Berhasil Dihapus');
    }
}
