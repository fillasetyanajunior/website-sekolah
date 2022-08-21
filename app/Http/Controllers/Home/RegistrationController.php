<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Department;
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
        return view('home.pendaftaran', compact('department_first','department_second','title','province'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'                  => ['required', 'max:255'],
            'nisn'                  => ['required', 'max:15'],
            'tempat_lahir'          => ['required', 'max:255'],
            'tanggal_lahir'         => ['required'],
            'jenis_kelamin'         => ['required'],
            'agama'                 => ['required'],
            'nomer_hp'              => ['required', 'max:12'],
            'email'                 => ['required', 'email'],
            'nama_ibu'              => ['required'],
            'nama_bapak'            => ['required'],
            'pendidikan_ibu'        => ['required'],
            'pendidikan_bapak'      => ['required'],
            'pekerjaan_ibu'         => ['required'],
            'pekerjaan_bapak'       => ['required'],
            'penghasilan_ibu'       => ['required'],
            'penghasilan_bapak'     => ['required'],
            'pendidikan'            => ['required'],
            'nama_sekolah'          => ['required'],
            'nama_jalan'            => ['required'],
            'rt'                    => ['required'],
            'rw'                    => ['required'],
            'dusun'                 => ['required'],
            'desa'                  => ['required'],
            'kecamatan'             => ['required'],
            'kabupaten'             => ['required'],
            'provinsi'              => ['required'],
            'kode_pos'              => ['required'],
            'pilihan_1'             => ['required'],
            'pilihan_2'             => ['required'],
            'info'                  => ['required'],
        ]);

        $alamat =   $request->provinsi . '/' . $request->kabupaten . '/' . $request->kecamatan
            . '/' . $request->desa . '/' . $request->dusun . '/' . $request->rw
            . '/' . $request->rt . '/' . $request->nama_jalan . '/' . $request->kode_pos;

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
            'nama'                  => $request->nama,
            'nisn'                  => $request->nisn,
            'tempat_lahir'          => $request->tempat_lahir,
            'tanggal_lahir'         => $request->tanggal_lahir,
            'jenis_kelamin'         => $jenis_kelamin,
            'agama'                 => $agama,
            'nomer_hp'              => $request->nomer_hp,
            'email'                 => $request->email,
            'nama_ibu'              => $request->nama_ibu,
            'nama_bapak'            => $request->nama_bapak,
            'pendidikan_ibu'        => $request->pendidikan_ibu,
            'pendidikan_bapak'      => $request->pendidikan_bapak,
            'pekerjaan_ibu'         => $request->pekerjaan_ibu,
            'pekerjaan_bapak'       => $request->pekerjaan_bapak,
            'penghasilan_ibu'       => $request->penghasilan_ibu,
            'penghasilan_bapak'     => $request->penghasilan_bapak,
            'pendidikan'            => $request->pendidikan,
            'nama_sekolah'          => $request->nama_sekolah,
            'alamat'                => $alamat,
        ]);

        $permitted_chars    = '0123456789';
        $kode               = substr(str_shuffle($permitted_chars), 0, 8);
        $int                = '1234567890';
        $password           = substr(str_shuffle($int), 0, 6);

        Registration::create([
            'id_siswa'              => $siswa->id,
            'kode'                  => $kode,
            'pilihan_1'             => $request->pilihan_1,
            'pilihan_2'             => $request->pilihan_2,
            'info'                  => $request->info,
            'password'              => $password,
            'is_active'             => 'belum test',
        ]);

        return redirect(route('regisration'))->with('success','Pendaftaran Berhasil  silahkan cek email anda');
    }
}
