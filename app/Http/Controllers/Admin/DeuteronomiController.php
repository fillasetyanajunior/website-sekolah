<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Deuteronomi;
use App\Models\StudentDetail;
use App\Models\Subject;
use App\Models\Year;
use Illuminate\Http\Request;

class DeuteronomiController extends AppController
{
    public function index()
    {
        $title          = 'Jadwal Ulangan';
        $deuteronomi    = Deuteronomi::groupBy('kelas')->select('kelas')->paginate(20);
        $subject        = Subject::all();
        $year           = Year::all();
        $department     = Department::all();
        return view('admin.deuteronomi.deuteronomi', compact('subject', 'year', 'department', 'deuteronomi', 'title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal'       => 'required',
            'jam'           => 'required',
            'matapelajaran' => 'required',
            'tahun'         => 'required',
            'jurusan'       => 'required',
            'kursi'         => 'required',
            'ruangan'       => 'required',
            'kelas_pertama' => 'required',
            'kelas_kedua'   => 'required',
        ]);

        //Deklarasi variabel kelas pertama
        if ($request->kelas_pertama == 1) {
            $kelas_pertama = 'X';
        } elseif ($request->kelas_pertama == 2) {
            $kelas_pertama = 'XI';
        } else {
            $kelas_pertama = 'XII';
        }

        $students_kelas_pertama         = StudentDetail::where('kelas', $kelas_pertama)->where('jurusan', $request->jurusan)->get();
        $students_kelas_pertamavalidasi = StudentDetail::where('kelas', $kelas_pertama)->where('jurusan', $request->jurusan)->first();
        $kursi_kelas_pertama            = round($request->kursi / 2);
        $cekkelas_pertama               = Deuteronomi::orderBy('id_siswa','DESC')->where('kelas', $kelas_pertama)->where('jurusan', $request->jurusan)->first();

        if ($cekkelas_pertama == null) {
            $id_siswa_kelas_pertama = 0;
        } else {
            $id_siswa_kelas_pertama = $cekkelas_pertama->id_siswa - 1;
        }


        //Deklarasi variabel kelas kedua
        if ($request->kelas_kedua == 1) {
            $kelas_kedua = 'X';
        } elseif ($request->kelas_kedua == 2) {
            $kelas_kedua = 'XI';
        } else {
            $kelas_kedua = 'XII';
        }

        $students_kelas_kedua           = StudentDetail::where('kelas', $kelas_kedua)->where('jurusan', $request->jurusan)->get();
        $students_kelas_keduavalidasi   = StudentDetail::where('kelas', $kelas_kedua)->where('jurusan', $request->jurusan)->first();
        $kursi_kelas_kedua              = $request->kursi - $kursi_kelas_pertama;
        $cekkelas_kedua                 = Deuteronomi::orderBy('id_siswa', 'DESC')->where('kelas', $kelas_kedua)->where('jurusan', $request->jurusan)->first();

        if ($cekkelas_kedua == null) {
            $id_siswa_kelas_kedua = 0;
        } else {
            $id_siswa_kelas_kedua = $cekkelas_kedua->id_siswa - 1;
        }

        $i = 1;
        if ($students_kelas_pertamavalidasi != null) {
            for ($id_siswa_kelas_pertama; $id_siswa_kelas_pertama < $kursi_kelas_pertama; $id_siswa_kelas_pertama++) {
                Deuteronomi::create([
                    'id_siswa'      => $students_kelas_pertama[$id_siswa_kelas_pertama]->id,
                    'tanggal'       => $request->tanggal,
                    'jam'           => $request->jam,
                    'matapelajaran' => $request->matapelajaran,
                    'tahun'         => $request->tahun,
                    'jurusan'       => $request->jurusan,
                    'kursi'         => $i++,
                    'ruangan'       => $request->ruangan,
                    'kelas'         => $kelas_pertama,
                ]);
            }
        }

        if ($students_kelas_keduavalidasi != null) {
            for ($id_siswa_kelas_kedua; $id_siswa_kelas_kedua < $kursi_kelas_kedua; $id_siswa_kelas_kedua++) {
                Deuteronomi::create([
                    'id_siswa'      => $students_kelas_kedua[$id_siswa_kelas_kedua]->id,
                    'tanggal'       => $request->tanggal,
                    'jam'           => $request->jam,
                    'matapelajaran' => $request->matapelajaran,
                    'tahun'         => $request->tahun,
                    'jurusan'       => $request->jurusan,
                    'kursi'         => $i++,
                    'ruangan'       => $request->ruangan,
                    'kelas'         => $kelas_pertama,
                ]);
            }
        }
        return redirect()->back()->with('success', 'Data Berhasil Ditambahkan');
    }

    public function edit(Deuteronomi $deuteronomi)
    {
        return response()->json($deuteronomi);
    }

    public function update(Request $request, Deuteronomi $deuteronomi)
    {
        Deuteronomi::where('id', $deuteronomi->id)
            ->update([
                'tanggal'       => $request->tanggal,
                'jam'           => $request->jam,
                'matapelajaran' => $request->matapelajaran,
                'tahun'         => $request->tahun,
                'jurusan'       => $request->jurusan,
                'kursi'         => $request->kursi,
                'kelas'         => $request->kelas,
            ]);
        return redirect()->back()->with('success', 'Data Berhasil Update');
    }

    public function destroy(Deuteronomi $deuteronomi)
    {
        Deuteronomi::destroy($deuteronomi->id);
        return redirect()->back()->with('success', 'Data Berhasil Delete');
    }
}
