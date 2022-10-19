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
                    'id_guru'   => $showteaching->id_guru,
                    'nama'      => $showteaching->matapelajaran,
                    'no_kelas'  => $showteaching->no_kelas,
                    'kelas'     => $showteaching->kelas,
                ]);
            }
        } else {
            foreach ($teaching as $showteaching) {
                Classroom::create([
                    'id_guru'   => $showteaching->id_guru,
                    'nama'      => $showteaching->matapelajaran,
                    'jurusan'   => $showteaching->jurusan,
                    'kelas'     => $showteaching->kelas,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Data Berhasil Ditambahkan');
    }

    public function edit(Classroom $classroom)
    {
        return response()->json($classroom);
    }

    public function update(Request $request, Classroom $classroom)
    {
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

    public function destroy(Classroom $classroom)
    {
        Classroom::destroy($classroom->id);
        return redirect()->back()->with('success', 'Data Berhasil Dihapus');
    }
}
