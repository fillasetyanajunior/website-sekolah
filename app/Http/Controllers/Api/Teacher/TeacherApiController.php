<?php

namespace App\Http\Controllers\Api\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Subject;
use App\Models\TeacherDetail;
use App\Models\Teaching;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherApiController extends AppController
{
    public function index()
    {
        $response = [
            'id'    => Auth::user()->id_guru,
            'nama'  => Auth::user()->name,
            'nip'   => Auth::user()->username,
        ];

        return response()->json($response);
    }

    public function showkelas(Request $request)
    {
        $request->only('id');
        $teaching = Teaching::groupBy('kelas')->where('id_guru', $request->id)->get('kelas');
        return response()->json($teaching);
    }

    public function showjurusan(Request $request)
    {
        if ($request->kelas == 'X') {
            $teaching  = Teaching::groupBy('no_kelas')->having('no_kelas', '!=', 'null')->where('id_guru', $request->id)->where('kelas', $request->kelas)->get('no_kelas');
        } else {
            $teaching  = Teaching::join('departments', 'teachings.jurusan','=', 'departments.id')->groupBy('departments.jurusan')
                                ->where('id_guru', $request->id)->where('kelas', $request->kelas)->get('departments.jurusan');
        }

        return response()->json($teaching);
    }

    public function showmapel(Request $request)
    {
        if ($request->kelas == 'X') {
            $teaching   = Teaching::join('subjects', 'teachings.matapelajaran', '=', 'subjects.id')
                               ->groupBy('subjects.matapelajaran')->where('id_guru', $request->id)
                                 ->where('no_kelas', $request->no_kelas)->where('kelas', $request->kelas)->get('subjects.matapelajaran');
        } else {
            $jurusan    = Department::where('jurusan', $request->jurusan)->first();
            $teaching   = Teaching::join('subjects', 'teachings.matapelajaran', '=', 'subjects.id')
                               ->groupBy('subjects.matapelajaran')->where('id_guru', $request->id)
                                 ->where('jurusan', $jurusan->id)->where('kelas', $request->kelas)->get('subjects.matapelajaran');
        }

        return response()->json($teaching);
    }
}
