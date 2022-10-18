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
        $class          = StudentDetail::groupBy('no_kelas')->get('no_kelas');
        return view('admin.deuteronomi.deuteronomi', compact('subject', 'year', 'department', 'deuteronomi', 'title', 'class'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal'       => 'required',
            'jam'           => 'required',
            'tahun'         => 'required',
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

        if ($request->kelas_pertama == 1) {
            $students_kelas_pertama         = StudentDetail::where('kelas', $kelas_pertama)->where('no_kelas', $request->no_kelas_pertama)->get();
            $students_kelas_pertamavalidasi = StudentDetail::where('kelas', $kelas_pertama)->where('no_kelas', $request->no_kelas_pertama)->first();
            $cek_kursi_kelas_pertama        = round($request->kursi / 2);
            $cekkelas_pertama               = Deuteronomi::orderBy('id_siswa','DESC')->where('kelas', $kelas_pertama)->where('no_kelas', $request->no_kelas_pertama)->first();
        }else{
            $students_kelas_pertama         = StudentDetail::where('kelas', $kelas_pertama)->where('jurusan', $request->jurusan_pertama)->get();
            $students_kelas_pertamavalidasi = StudentDetail::where('kelas', $kelas_pertama)->where('jurusan', $request->jurusan_pertama)->first();
            $cek_kursi_kelas_pertama        = round($request->kursi / 2);
            $cekkelas_pertama               = Deuteronomi::orderBy('id_siswa','DESC')->where('kelas', $kelas_pertama)->where('jurusan', $request->jurusan_pertama)->first();
        }


        if ((count($students_kelas_pertama)/2) < $cek_kursi_kelas_pertama) {
            $kursi_kelas_pertama = count($students_kelas_pertama);
        }else {
            $kursi_kelas_pertama = round($request->kursi / 2);
        }

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

        if ($request->kelas_kedua == 1) {
            $students_kelas_kedua           = StudentDetail::where('kelas', $kelas_kedua)->where('no_kelas', $request->no_kelas_kedua)->get();
            $students_kelas_keduavalidasi   = StudentDetail::where('kelas', $kelas_kedua)->where('no_kelas', $request->no_kelas_kedua)->first();
            $cek_kursi_kelas_kedua          = $request->kursi - $kursi_kelas_pertama;
            $cekkelas_kedua                 = Deuteronomi::orderBy('id_siswa', 'DESC')->where('kelas', $kelas_kedua)->where('no_kelas', $request->no_kelas_kedua)->first();
        }else {
            $students_kelas_kedua           = StudentDetail::where('kelas', $kelas_kedua)->where('jurusan', $request->jurusan_kedua)->get();
            $students_kelas_keduavalidasi   = StudentDetail::where('kelas', $kelas_kedua)->where('jurusan', $request->jurusan_kedua)->first();
            $cek_kursi_kelas_kedua          = $request->kursi - $kursi_kelas_pertama;
            $cekkelas_kedua                 = Deuteronomi::orderBy('id_siswa', 'DESC')->where('kelas', $kelas_kedua)->where('jurusan', $request->jurusan_kedua)->first();
        }

        if ((count($students_kelas_kedua) / 2) < $cek_kursi_kelas_kedua) {
            $kursi_kelas_kedua = count($students_kelas_kedua);
        } else {
            $kursi_kelas_kedua = $request->kursi - $kursi_kelas_pertama;
        }

        if ($cekkelas_kedua == null) {
            $id_siswa_kelas_kedua = 0;
        } else {
            $id_siswa_kelas_kedua = $cekkelas_kedua->id_siswa - 1;
        }

        $i = 1;
        if ($students_kelas_pertamavalidasi != null) {
            for ($id_siswa_kelas_pertama; $id_siswa_kelas_pertama < $kursi_kelas_pertama; $id_siswa_kelas_pertama++) {
                if ($request->kelas_pertama == 1) {
                    $this->addkelas($students_kelas_pertama[$id_siswa_kelas_pertama]->id, $request->tanggal, $request->jam, $request->matapelajaran_pertama, $request->tahun, $request->no_kelas_pertama, $i++, $request->ruangan, $kelas_pertama);
                } else {
                    $this->addjurusan($students_kelas_pertama[$id_siswa_kelas_pertama]->id, $request->tanggal, $request->jam, $request->matapelajaran_pertama, $request->tahun, $request->jurusan_kedua, $i++, $request->ruangan, $kelas_pertama);
                }
            }
        }

        if ($students_kelas_keduavalidasi != null) {
            for ($id_siswa_kelas_kedua; $id_siswa_kelas_kedua < $kursi_kelas_kedua; $id_siswa_kelas_kedua++) {
                if ($request->kelas_kedua == 1) {
                    $this->addkelas($students_kelas_kedua[$id_siswa_kelas_kedua]->id, $request->tanggal, $request->jam, $request->matapelajaran_kedua, $request->tahun, $request->no_kelas_kedua, $i++, $request->ruangan, $kelas_kedua);
                } else {
                    $this->addjurusan($students_kelas_kedua[$id_siswa_kelas_kedua]->id, $request->tanggal, $request->jam, $request->matapelajaran_kedua, $request->tahun, $request->jurusan_kedua, $i++, $request->ruangan, $kelas_kedua);
                }
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
        if ($request->kelas == 1) {
            $this->updatekelas($deuteronomi->matapelajaran, $deuteronomi->kelas, $deuteronomi->tahun, $request->tanggal, $request->jam, $request->matapelajaran, $request->tahun, $request->no_kelas, $request->ruangan, $request->kelas);
        } else {
            $this->updatejurusan($deuteronomi->matapelajaran, $deuteronomi->kelas, $deuteronomi->tahun, $request->tanggal, $request->jam, $request->matapelajaran, $request->tahun, $request->jurusan, $request->ruangan, $request->kelas);
        }

        return redirect()->back()->with('success', 'Data Berhasil Update');
    }

    public function destroy(Deuteronomi $deuteronomi)
    {
        Deuteronomi::destroy($deuteronomi->id);
        return redirect()->back()->with('success', 'Data Berhasil Delete');
    }

    public function addjurusan($id_siswa, $tanggal, $jam, $matapelajaran, $tahun, $jurusan, $kursi, $ruangan, $kelas)
    {
        Deuteronomi::create([
            'id_siswa'      => $id_siswa,
            'tanggal'       => $tanggal,
            'jam'           => $jam,
            'matapelajaran' => $matapelajaran,
            'tahun'         => $tahun,
            'jurusan'       => $jurusan,
            'kursi'         => $kursi,
            'ruangan'       => $ruangan,
            'kelas'         => $kelas,
        ]);
    }

    public function addkelas($id_siswa, $tanggal, $jam, $matapelajaran, $tahun, $no_kelas, $kursi, $ruangan, $kelas)
    {
        Deuteronomi::create([
            'id_siswa'      => $id_siswa,
            'tanggal'       => $tanggal,
            'jam'           => $jam,
            'matapelajaran' => $matapelajaran,
            'tahun'         => $tahun,
            'no_kelas'      => $no_kelas,
            'kursi'         => $kursi,
            'ruangan'       => $ruangan,
            'kelas'         => $kelas,
        ]);
    }

    public function updatejurusan($edit_matapelajaran, $edit_kelas, $edit_tahun, $tanggal, $jam, $matapelajaran, $tahun, $jurusan, $ruangan, $kelas)
    {
        Deuteronomi::where('matapelajaran', $edit_matapelajaran)->where('kelas', $edit_kelas)->where('tahun', $edit_tahun)
            ->update([
            'tanggal'       => $tanggal,
            'jam'           => $jam,
            'matapelajaran' => $matapelajaran,
            'tahun'         => $tahun,
            'jurusan'       => $jurusan,
            'ruangan'       => $ruangan,
            'kelas'         => $kelas,
        ]);
    }

    public function updatekelas($edit_matapelajaran, $edit_kelas, $edit_tahun, $tanggal, $jam, $matapelajaran, $tahun, $no_kelas, $ruangan, $kelas)
    {
        Deuteronomi::where('matapelajaran', $edit_matapelajaran)->where('kelas', $edit_kelas)->where('tahun', $edit_tahun)
            ->update([
            'tanggal'       => $tanggal,
            'jam'           => $jam,
            'matapelajaran' => $matapelajaran,
            'tahun'         => $tahun,
            'no_kelas'      => $no_kelas,
            'ruangan'       => $ruangan,
            'kelas'         => $kelas,
        ]);
    }
}
