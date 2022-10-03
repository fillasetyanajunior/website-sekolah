<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Teaching;
use Illuminate\Http\Request;

class ClassroomController extends AppController
{
    public function index()
    {
        $title      = 'Ruang Kelas';
        $classroom  = Classroom::orderBy('jurusan')->paginate(20);
        return view('admin.classroom.classroom',compact('title', 'classroom'));
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

        $teaching = Teaching::where('kelas',$kelas)->get();
        foreach ($teaching as $showteaching) {
            Classroom::create([
                'id_guru'   => $showteaching->id_guru,
                'nama'      => $showteaching->matapelajaran,
                'jurusan'   => $showteaching->jurusan,
                'kelas'     => $showteaching->kelas,
            ]);
        }

        return redirect()->back()->with('success', 'Data Berhasil Ditambahkan');
    }

    public function edit(Classroom $classroom)
    {
        return response()->json($classroom);
    }

    public function update(Request $request, Classroom $classroom)
    {
        Classroom::where('id', $classroom->id)
                ->update([
                    'id_guru'   => $request->id_guru,
                    'nama'      => $request->matapelajaran,
                    'jurusan'   => $request->jurusan,
                    'kelas'     => $request->kelas,
                ]);
        return redirect()->back()->with('success', 'Data Berhasil Diubah');
    }

    public function destroy(Classroom $classroom)
    {
        Classroom::destroy($classroom->id);
        return redirect()->back()->with('success', 'Data Berhasil Dihapus');
    }
}
