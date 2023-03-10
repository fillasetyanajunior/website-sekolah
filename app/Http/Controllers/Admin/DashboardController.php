<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RegistrationDetail;
use App\Models\Registration;
use Illuminate\Http\Request;

class DashboardController extends AppController
{
    public function index()
    {
        $title      = 'Dashboard';
        $register   = Registration::orderBy('created_at', 'DESC')->limit(10)->get();
        return view('admin.dashboard', compact('title', 'register'));
    }

    public function testdata()
    {
        $tanggalall = RegistrationDetail::orderBy('created_at','DESC')->groupBy('created_at')->get('created_at');

        $tanggal = [];
        $validasitanggal = null;
        foreach ($tanggalall as $showtanggalall) {
            if (count($tanggal) < 100) {
                if ($validasitanggal != date('Y-m', strtotime($showtanggalall->created_at))) {
                    $tanggal[] = date('Y-m', strtotime($showtanggalall->created_at));
                }
                $validasitanggal = date('Y-m', strtotime($showtanggalall->created_at));
            }
        }

        $laki_laki = [];
        foreach ($tanggal as $showtanggal) {
            $laki_laki[] = RegistrationDetail::where('jenis_kelamin', 'Laki-laki')->where('created_at', 'like', '%' . $showtanggal . '%')->count();
        }

        $perempuan = [];
        foreach ($tanggal as $showtanggal) {
            $perempuan[] = RegistrationDetail::where('jenis_kelamin', 'Perempuan')->where('created_at', 'like', '%' . $showtanggal . '%')->count();
        }

        return response()->json([
            'laki_laki' => $laki_laki,
            'perempuan' => $perempuan,
            'tanggal'   => $tanggal,
        ]);
    }
}
