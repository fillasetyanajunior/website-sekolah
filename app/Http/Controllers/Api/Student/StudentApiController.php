<?php

namespace App\Http\Controllers\Api\Student;

use App\Http\Controllers\Controller;
use App\Models\StudentDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class StudentApiController extends Controller
{
    public function index()
    {
        if (request()->user()->currentAccessToken()->name != 'student') {
            return response()->json(['status' => 'error']);
        }

        $avatar = StudentDetail::find(Auth::user()->id_siswa)->avatar;
        if ($avatar == null) {
            return response()->json([
                'id'        => Auth::user()->id_siswa,
                'nama'      => Auth::user()->name,
                'nis'       => Auth::user()->username,
                'profile'   => url('assets/dashboard/dist/img/default.png'),
            ]);
        } else {
            return response()->json([
                'id'        => Auth::user()->id_siswa,
                'nama'      => Auth::user()->name,
                'nis'       => Auth::user()->username,
                'profile'   => Storage::url($avatar),
            ]);
        }
    }

    public function show()
    {
        if (request()->user()->currentAccessToken()->name != 'student') {
            return response()->json(['status' => 'error']);
        }

        $avatar = StudentDetail::find(Auth::user()->id_siswa)->avatar;
        if ($avatar == null) {
            return response()->json([
                'nama'      => Auth::user()->name,
                'nis'       => Auth::user()->username,
                'profile'   => url('assets/dashboard/dist/img/default.png'),
            ]);
        } else {
            return response()->json([
                'nama'      => Auth::user()->name,
                'nis'       => Auth::user()->username,
                'profile'   => Storage::url($avatar),
            ]);
        }
    }
}
