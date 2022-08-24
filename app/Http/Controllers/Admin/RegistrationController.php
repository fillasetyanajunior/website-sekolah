<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Registration;
use App\Models\RegistrationDetail;
use App\Models\Student;
use App\Models\StudentDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RegistrationController extends AppController
{
    public function index()
    {
        $title          = "Data Pendaftaran";
        $registration   = Registration::paginate(20);
        $department     = Department::paginate(20);
        return view('admin.pendaftaran.pendaftaran', compact('registration', 'department', 'title'));
    }

    public function edit(Registration $registration)
    {
        return response()->json(['registration' => $registration, 'detail' => RegistrationDetail::find($registration->id_siswa)]);
    }

    public function update(Request $request, Registration $registration)
    {
        Registration::where('id', $registration->id)
            ->update([
                'is_active' => $request->active,
            ]);
        if ($request->active == 3) {

            $detail = RegistrationDetail::find($registration->id_siswa);

            StudentDetail::create([
                'nama'                  => $detail->nama,
                'nisn'                  => $detail->nisn,
                'tempat_lahir'          => $detail->tempat_lahir,
                'tanggal_lahir'         => $detail->tanggal_lahir,
                'jenis_kelamin'         => $detail->jenis_kelamin,
                'agama'                 => $detail->agama,
                'nomer_hp'              => $detail->nomer_hp,
                'email'                 => $detail->email,
                'nama_ibu'              => $detail->nama_ibu,
                'nama_bapak'            => $detail->nama_bapak,
                'pendidikan_ibu'        => $detail->pendidikan_ibu,
                'pendidikan_bapak'      => $detail->pendidikan_bapak,
                'pekerjaan_ibu'         => $detail->pekerjaan_ibu,
                'pekerjaan_bapak'       => $detail->pekerjaan_bapak,
                'penghasilan_ibu'       => $detail->penghasilan_ibu,
                'penghasilan_bapak'     => $detail->penghasilan_bapak,
                'pendidikan'            => $detail->pendidikan,
                'nama_sekolah'          => $detail->nama_sekolah,
                'alamat'                => $detail->alamat,
                'jurusan'               => $request->jurusan,
                'foto'                  => '',
            ]);
        }

        Registration::destroy($registration->id);
        RegistrationDetail::destroy($registration->id_siswa);

        return redirect()->route('admin.registration')->with('success', 'Data Berhasil Update');
    }
}
