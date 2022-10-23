<?php

namespace App\Http\Controllers\Api\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\QrCode;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CodeQrApiController extends AppController
{
    public function create(Request $request)
    {
        $jurusan        = Department::where('jurusan', $request->jurusan)->first();
        $matapelajaran  = Subject::where('matapelajaran', $request->matapelajaran)->first();
        $int            = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $kode           =  substr(str_shuffle($int), 0, 6);

        if ($request->kelas == 'X') {
            $qr = QrCode::create([
                            'kode'          => $kode,
                            'matapelajaran' => $matapelajaran->id,
                            'no_kelas'      => $request->no_kelas,
                            'kelas'         => $request->kelas,
                        ]);
        } else {
            $qr = QrCode::create([
                            'kode'          => $kode,
                            'matapelajaran' => $matapelajaran->id,
                            'jurusan'       => $jurusan->id,
                            'kelas'         => $request->kelas,
                        ]);
        }
        return response()->json($qr);
    }

    public function update(Request $request)
    {
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
        QrCode::where('kode', $request->qr)->delete();

        return response()->json(200);
    }
}
