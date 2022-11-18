<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Deuteronomi;
use App\Models\Employment;
use App\Models\Province;
use App\Models\Schedule;
use App\Models\StudentDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class DashboardController extends AppController
{
    public function index()
    {
        $title          = 'Dashboard';
        $student        = StudentDetail::find(Auth::user()->id_siswa);
        if ($student->kelas == 'X') {
            $schedule = Schedule::orderBy('hari')->where('kelas', $student->kelas)->where('no_kelas', $student->no_kelas)->get();
        } else {
            $schedule = Schedule::orderBy('hari')->where('kelas', $student->kelas)->where('jurusan', $student->jurusan)->get();
        }

        $deuteronomi    = Deuteronomi::where('id_siswa', Auth::user()->id_siswa)->get();
        return view('student.dashboard', compact('title', 'deuteronomi', 'schedule'));
    }

    public function profile()
    {
        $title      = 'Profile';
        $student    = StudentDetail::find(Auth::user()->id_siswa);
        $province   = Province::all();
        $job        = Employment::all();
        return view('student.profile', compact('title', 'student', 'province', 'job'));
    }

    public function update(Request $request)
    {
        StudentDetail::where('id', Crypt::decrypt($request->id))
                    ->update([
                        'nisn'              => $request->nisn,
                        'tempat_lahir'      => $request->tempat_lahir,
                        'tanggal_lahir'     => $request->tanggal_lahir,
                        'nomer_hp'          => $request->nomer_hp != null ? $request->nomer_hp : '-',
                        'email'             => $request->email != null ? $request->email : '-',
                        'nama_ibu'          => $request->nama_ibu,
                        'pendidikan_ibu'    => $request->pendidikan_ibu != null ? $request->pendidikan_ibu : 0,
                        'pekerjaan_ibu'     => $request->pekerjaan_ibu != null ? $request->pekerjaan_ibu : 0,
                        'penghasilan_ibu'   => $request->penghasilan_ibu != null ? $request->penghasilan_ibu : 0,
                        'nama_bapak'        => $request->nama_bapak,
                        'pendidikan_bapak'  => $request->pendidikan_bapak != null ? $request->pendidikan_bapak : 0,
                        'pekerjaan_bapak'   => $request->pekerjaan_bapak != null ? $request->pekerjaan_bapak : 0,
                        'penghasilan_bapak' => $request->penghasilan_bapak != null ? $request->penghasilan_bapak : 0,
                        'pendidikan'        => $request->pendidikan != null ? $request->pendidikan : 0,
                        'nama_sekolah'      => $request->nama_sekolah != null ? $request->nama_sekolah : '-',
                        'provinsi_id'       => $request->provinsi,
                        'kabupaten_id'      => $request->kabupaten,
                        'kecamatan_id'      => $request->kecamatan,
                        'desa_id'           => $request->desa,
                        'dusun'             => $request->dusun,
                        'rw'                => $request->rw != null ? $request->rw : '00',
                        'rt'                => $request->rt != null ? $request->rt : '00',
                        'alamat'            => $request->alamat,
                        'kode_pos'          => $request->kode_pos,
                    ]);
        return redirect()->back()->with('success', 'Update Data Berhasil');
    }
}
