<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Employment;
use App\Models\Province;
use App\Models\Registration;
use App\Models\RegistrationDetail;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function index()
    {
        $title              = 'Pendaftaran';
        $province           = Province::all();
        $department_first   = Department::all();
        $department_second  = Department::all();
        $employment         = Employment::all();
        return view('home.pendaftaran', compact('department_first', 'department_second', 'title', 'province', 'employment'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'              => 'required',
            'nik'               => 'required',
            'nisn'              => 'required',
            'tempat_lahir'      => 'required',
            'tanggal_lahir'     => 'required',
            'jenis_kelamin'     => 'required',
            'agama'             => 'required',
            'nomer_hp_siswa'    => 'required',
            'email'             => 'required',
            'nama_ibu'          => 'required',
            'nama_bapak'        => 'required',
            'nik_ibu'           => 'required',
            'pendidikan_ibu'    => 'required',
            'nik_bapak'         => 'required',
            'pendidikan_bapak'  => 'required',
            'pekerjaan_ibu'     => 'required',
            'pekerjaan_bapak'   => 'required',
            'penghasilan_ibu'   => 'required',
            'penghasilan_bapak' => 'required',
            'nomer_hp_wali'     => 'required',
            'pendidikan'        => 'required',
            'nama_sekolah'      => 'required',
            'provinsi_id'       => 'required',
            'kabupaten_id'      => 'required',
            'kecamatan_id'      => 'required',
            'desa_id'           => 'required',
            'dusun'             => 'required',
            'rw'                => 'required',
            'rt'                => 'required',
            'alamat'            => 'required',
            'kode_pos'          => 'required',
            'info'              => 'required',
        ]);

        if ($request->jenis_kelamin == 1) {
            $jenis_kelamin = 'Laki-laki';
        } else {
            $jenis_kelamin = 'Perempuan';
        }

        if ($request->agama == 1) {
            $agama = 'Islam';
        }elseif ($request->agama == 2) {
            $agama = 'Hindu';
        }elseif ($request->agama == 2) {
            $agama = 'Budha';
        }elseif ($request->agama == 2) {
            $agama = 'Kristen';
        }elseif ($request->agama == 2) {
            $agama = 'Katolik';
        } else {
            $agama = 'Kong Hu Cu';
        }

        $siswa = RegistrationDetail::create([
            'nama'              => $request->nama,
            'nik'               => $request->nik,
            'nisn'              => $request->nisn,
            'tempat_lahir'      => $request->tempat_lahir,
            'tanggal_lahir'     => $request->tanggal_lahir,
            'jenis_kelamin'     => $jenis_kelamin,
            'agama'             => $agama,
            'nomer_hp_siswa'    => $request->nomer_hp_siswa,
            'email'             => $request->email,
            'nik_ibu'           => $request->nik_ibu,
            'nama_ibu'          => $request->nama_ibu,
            'nik_bapak'         => $request->nik_bapak,
            'nama_bapak'        => $request->nama_bapak,
            'pendidikan_ibu'    => $request->pendidikan_ibu,
            'pendidikan_bapak'  => $request->pendidikan_bapak,
            'pekerjaan_ibu'     => $request->pekerjaan_ibu,
            'pekerjaan_bapak'   => $request->pekerjaan_bapak,
            'penghasilan_ibu'   => $request->penghasilan_ibu,
            'penghasilan_bapak' => $request->penghasilan_bapak,
            'nomer_hp_wali'     => $request->nomer_hp_wali,
            'pendidikan'        => $request->pendidikan,
            'nama_sekolah'      => $request->nama_sekolah,
            'provinsi_id'       => $request->provinsi,
            'kabupaten_id'      => $request->kabupaten,
            'kecamatan_id'      => $request->kecamatan,
            'desa_id'           => $request->desa,
            'dusun'             => $request->dusun,
            'rw'                => $request->rw,
            'rt'                => $request->rt,
            'alamat'            => $request->nama_jalan,
            'kode_pos'          => $request->kode_pos,
        ]);

        $permitted_chars    = '0123456789';
        $kode               = substr(str_shuffle($permitted_chars), 0, 8);
        $int                = '1234567890';
        $password           = substr(str_shuffle($int), 0, 6);

        Registration::create([
            'id_registration'   => $siswa->id,
            'kode'              => $kode,
            'info'              => $request->info,
            'password'          => $password,
            'is_active'         => 'belum test',
        ]);

        return redirect(route('regisration'))->with('success', 'Pendaftaran Berhasil  silahkan cek email anda');
    }
}
