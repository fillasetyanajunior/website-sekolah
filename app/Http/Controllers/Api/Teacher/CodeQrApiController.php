<?php

namespace App\Http\Controllers\Api\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\QrCode;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CodeQrApiController extends Controller
{
    public function create(Request $request)
    {
        if (request()->user()->currentAccessToken()->name != 'teacher') {
            return response()->json(['status' => 'error']);
        }

        if ($request->kelas == 1) {
            $kelas = 'X';
        } elseif ($request->kelas == 2) {
            $kelas = 'XI';
        } else {
            $kelas = 'XII';
        }

        $jurusan        = Department::where('jurusan',$request->jurusan)->first();
        $matapelajaran  = Subject::where('matapelajaran',$request->matapelajaran)->first();

        $int    = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $kode   =  substr(str_shuffle($int), 0, 6);
        $qr     = QrCode::create([
                                'kode'          => $kode,
                                'matapelajaran'         => $matapelajaran->id,
                                'jurusan'       => $jurusan->id,
                                'kelas'         => $kelas,
                            ]);

        return response()->json($qr);
    }

    public function update(Request $request)
    {
        if (request()->user()->currentAccessToken()->name != 'teacher') {
            return response()->json(['status' => 'error']);
        }

        $int    = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $kode   =  substr(str_shuffle($int), 0, 6);
        QrCode::where('kode', $request->kode)
                ->update([
                    'kode'  => $kode,
                ]);

        return response()->json(['kode' => $kode]);
    }

    public function destroy(Request $request)
    {
        if (request()->user()->currentAccessToken()->name != 'teacher') {
            return response()->json(['status' => 'error']);
        }

        QrCode::where('kode', $request->qr)->delete();

        return response()->json(200);
    }
}
