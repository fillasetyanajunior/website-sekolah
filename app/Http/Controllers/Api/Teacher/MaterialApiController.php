<?php

namespace App\Http\Controllers\Api\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\MaterialInput;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MaterialApiController extends AppController
{
    public function index(Request $request)
    {
        $mapel = Subject::where('matapelajaran', $request->matapelajaran)->first();

        $data = MaterialInput::where('guru', Auth::user()->id)
                             ->where('matapelajaran', $mapel->id)
                             ->where('kelas', $request->kelas)
                             ->get();

        return response()->json($data);
    }

    public function store(Request $request)
    {
        $mapel      = Subject::where('matapelajaran', $request->matapelajaran)->first();
        $jurusan    = Department::where('jurusan', $request->jurusan)->first();

        if ($request->kelas == 'X') {
            MaterialInput::create([
                'judul'         => $request->judul,
                'pembahasan'    => $request->pembahasan,
                'kelas'         => $request->kelas,
                'matapelajaran' => $mapel->id,
                'no_kelas'      => $request->no_kelas,
                'guru'          => Auth::user()->id,
            ]);
        } else {
            MaterialInput::create([
                'judul'         => $request->judul,
                'pembahasan'    => $request->pembahasan,
                'kelas'         => $request->kelas,
                'matapelajaran' => $mapel->id,
                'jurusan'       => $jurusan->id,
                'guru'          => Auth::user()->id,
            ]);
        }


        return response()->json(['status_code' => 200]);
    }
}
