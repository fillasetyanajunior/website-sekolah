<?php

namespace App\Http\Controllers\Api\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\MaterialInput;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MaterialApiController extends Controller
{
    public function index(Request $request)
    {
        if (request()->user()->currentAccessToken()->name != 'teacher') {
            return response()->json(['status_code' => 400]);
        }

        $mapel = Subject::where('matapelajaran', $request->mapel)->first();

        $data = MaterialInput::where('guru', Auth::user()->id)
                                ->where('mapel', $mapel->id)
                                ->where('kelas', $request->kelas)
                                ->get();

        return response()->json($data);
    }

    public function store(Request $request)
    {
        if (request()->user()->currentAccessToken()->name != 'teacher') {
            return response()->json(['status_code' => 400]);
        }

        $mapel      = Subject::where('matapelajaran', $request->mapel)->first();
        $jurusan    = Department::where('jurusan', $request->jurusan)->first();

        MaterialInput::create([
            'judul'         => $request->judul,
            'pembahasan'    => $request->pembahasan,
            'kelas'         => $request->kelas,
            'mapel'         => $mapel->id,
            'jurusan'       => $jurusan->id,
            'guru'          => Auth::user()->id,
        ]);

        return response()->json(['status_code' => 200]);
    }
}
