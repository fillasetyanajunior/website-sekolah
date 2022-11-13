<?php

namespace App\Http\Controllers\Counselingguidance;

use App\Http\Controllers\Controller;
use App\Models\Offance;
use App\Models\StudentDetail;
use App\Models\StudentOffance;
use App\Models\TeacherDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class OffenseController extends AppController
{
    public function index()
    {
        $title          = 'Input Pelanggaran';
        $offensestudent = StudentOffance::paginate(30);
        $offense        = Offance::all();
        $student        = StudentDetail::all();
        $teacher        = TeacherDetail::all();
        return view('counselingguidance.offense.offense', compact('title', 'offensestudent', 'offense', 'student', 'teacher'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal'       => 'required',
            'nama'          => 'required',
            'pelanggaran'   => 'required',
            'pilihan'       => 'required',
            'pelapor'       => 'required',
            'pembinaan'     => 'required',
            'keterangan'    => 'required',
        ]);

        if ($request->pilihan == 1) {
            $pilihan = 'Guru';
        } else {
            $pilihan = 'Lainnya';
        }

        if ($request->pembinaan == 1) {
            $pembinaan = 'Lisan';
        }elseif ($request->pembinaan == 2) {
            $pembinaan = 'Perjanjian 1';
        }elseif ($request->pembinaan == 3) {
            $pembinaan = 'Perjanjian 2';
        }elseif ($request->pembinaan == 4) {
            $pembinaan = 'Panggilan Orang Tua';
        }elseif ($request->pembinaan == 5) {
            $pembinaan = 'Skorsing';
        } else {
            $pembinaan = 'Lainnya';
        }

        $skor = Offance::where('nama', $request->pelanggaran)->first();

        if ($request->pembinaan == 6) {
            StudentOffance::create([
                'tanggal'           => $request->tanggal,
                'id_siswa'          => StudentDetail::where('nama', $request->nama)->first()->id,
                'skor'              => $skor->skor,
                'jenis_pelanggaran' => $request->pelanggaran,
                'pilihan_pelapor'   => $pilihan,
                'pelapor'           => $request->pelapor,
                'pembinaan'         => $pembinaan,
                'pembinaan_lainnya' => $request->pembinaan_lainnya,
                'keterangan'        => $request->keterangan,
            ]);
        } else {
            StudentOffance::create([
                'tanggal'           => $request->tanggal,
                'id_siswa'          => StudentDetail::where('nama', $request->nama)->first()->id,
                'skor'              => $skor->skor,
                'jenis_pelanggaran' => $request->pelanggaran,
                'pilihan_pelapor'   => $pilihan,
                'pelapor'           => $request->pelapor,
                'pembinaan'         => $pembinaan,
                'keterangan'        => $request->keterangan,
            ]);
        }

        return redirect()->back()->with('success', 'Data Berhasil Ditambahkan');
    }

    public function edit(Request $request)
    {
        return response()->json(StudentOffance::find(Crypt::decrypt($request->studentOffence)));
    }

    public function update(Request $request)
    {
        if ($request->pilihan == 1) {
            $pilihan = 'Guru';
        } else {
            $pilihan = 'Lainnya';
        }

        if ($request->pembinaan == 1) {
            $pembinaan = 'Lisan';
        } elseif ($request->pembinaan == 2) {
            $pembinaan = 'Perjanjian 1';
        } elseif ($request->pembinaan == 3) {
            $pembinaan = 'Perjanjian 2';
        } elseif ($request->pembinaan == 4) {
            $pembinaan = 'Panggilan Orang Tua';
        } elseif ($request->pembinaan == 5) {
            $pembinaan = 'Skorsing';
        } else {
            $pembinaan = 'Lainnya';
        }

        $skor = Offance::where('nama', $request->pelanggaran)->first();

        if ($request->pembinaan == 6) {
            StudentOffance::where('id', Crypt::decrypt($request->studentOffence))
                ->update([
                'tanggal'           => $request->tanggal,
                'id_siswa'          => StudentDetail::where('nama', $request->nama)->first()->id,
                'skor'              => $skor->skor,
                'jenis_pelanggaran' => $request->pelanggaran,
                'pilihan_pelapor'   => $pilihan,
                'pelapor'           => $request->pelapor,
                'pembinaan'         => $pembinaan,
                'pembinaan_lainnya' => $request->pembinaan_lainnya,
                'keterangan'        => $request->keterangan,
            ]);
        } else {
            StudentOffance::where('id', Crypt::decrypt($request->studentOffence))
                ->update([
                'tanggal'           => $request->tanggal,
                'id_siswa'          => StudentDetail::where('nama', $request->nama)->first()->id,
                'skor'              => $skor->skor,
                'jenis_pelanggaran' => $request->pelanggaran,
                'pilihan_pelapor'   => $pilihan,
                'pelapor'           => $request->pelapor,
                'pembinaan'         => $pembinaan,
                'keterangan'        => $request->keterangan,
            ]);
        }

        return redirect()->back()->with('success', 'Data Berhasil Diubah');
    }

    public function destroy(Request $request)
    {
        StudentOffance::destroy(Crypt::decrypt($request->studentOffence));
        return redirect()->back()->with('success', 'Data Berhasil Dihapus');

    }
}
