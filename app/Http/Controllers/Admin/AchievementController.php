<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Achievement;
use Illuminate\Http\Request;

class AchievementController extends AppController
{
    public function index()
    {
        $title          = 'Prestasi Siswa';
        $achievement    = Achievement::paginate(20);
        return view('admin.achievement.achievement',compact('title', 'achievement'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kegiatan'      => 'required',
            'penyelenggara' => 'required',
            'juara'         => 'required',
            'keterangan'    => 'required',
            'tahun'         => 'required',
            'tingkatan'     => 'required',
            'prestasi'      => 'required',
        ]);

        if ($request->prestasi == 1) {
            $prestasi = 'Akademik';
        } else {
            $prestasi = 'Non-Akademik';
        }

        Achievement::create([
            'kegiatan'      => $request->kegiatan,
            'penyelenggara' => $request->penyelenggara,
            'juara'         => $request->juara,
            'keterangan'    => $request->keterangan,
            'tahun'         => $request->tahun,
            'tingkatan'     => $request->tingkatan,
            'prestasi'      => $prestasi,
        ]);

        return redirect()->back()->with('success', 'Data Berhasil Ditambahkan');
    }

    public function edit(Achievement $achievement)
    {
        return response()->json($achievement);
    }

    public function update(Request $request, Achievement $achievement)
    {
        if ($request->prestasi == 1) {
            $prestasi = 'Akademik';
        } else {
            $prestasi = 'Non-Akademik';
        }

        Achievement::where('id', $achievement->id)
                    ->update([
                        'kegiatan'      => $request->kegiatan,
                        'penyelenggara' => $request->penyelenggara,
                        'juara'         => $request->juara,
                        'keterangan'    => $request->keterangan,
                        'tahun'         => $request->tahun,
                        'tingkatan'     => $request->tingkatan,
                        'prestasi'      => $prestasi,
                    ]);

        return redirect()->back()->with('success', 'Data Berhasil Diupdate');
    }

    public function destroy(Achievement $achievement)
    {
        Achievement::destroy($achievement->id);
        return redirect()->back()->with('success', 'Data Berhasil Dihapus');
    }
}
