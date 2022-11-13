<?php

namespace App\Http\Controllers\Attendance;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\QrCode;
use SimpleSoftwareIO\QrCode\Facades\QrCode as Qr;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class CodeQrController extends AppController
{
    public function store(Request $request)
    {
        $int            = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $kode           =  substr(str_shuffle($int), 0, 6);

        if ($request->kelas == 'X') {
            $qr = QrCode::create([
                'kode'          => $kode,
                'matapelajaran' => Crypt::decrypt($request->matapelajaran),
                'no_kelas'      => $request->no_kelas,
                'kelas'         => $request->kelas,
            ]);
        } else {
            $qr = QrCode::create([
                'kode'          => $kode,
                'matapelajaran' => Crypt::decrypt($request->matapelajaran),
                'jurusan'       => Crypt::decrypt($request->jurusan),
                'kelas'         => $request->kelas,
            ]);
        }
        return response()->json(['status_code' => 200, 'kode' => $qr->kode, 'qr' => "data:image/png;base64," . base64_encode(Qr::format("png")->size(800)->generate($qr->kode))]);
    }

    public function update(Request $request)
    {
        $int    = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $kode   =  substr(str_shuffle($int), 0, 6);
        QrCode::where('kode', $request->kode)
            ->update([
                'kode' => $kode,
            ]);

        return response()->json(['status_code' => 200, 'kode' => $kode, 'qr' => "data:image/png;base64," . base64_encode(Qr::format("png")->size(800)->generate($kode))]);
    }

    public function destroy(Request $request)
    {
        QrCode::where('kode', $request->kode)->delete();

        return response()->json(['status_code' => 200]);
    }
}
