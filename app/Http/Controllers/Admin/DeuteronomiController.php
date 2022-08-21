<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Deuteronomi;
use App\Models\Subject;
use App\Models\Year;
use Illuminate\Http\Request;

class DeuteronomiController extends AppController
{
    public function index()
    {
        $title          = 'Jadwal Ulangan';
        $deuteronomi    = Deuteronomi::paginate(20);
        $subject        = Subject::all();
        $year           = Year::all();
        $department     = Department::all();
        return view('admin.ulangan.ulangan', compact('subject', 'year', 'department', 'deuteronomi', 'title'));
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

        $kelas = $request->kelas_pertama . '/' . $request->kelas_kedua;

        Deuteronomi::create([
            'tanggal'       => $request->tanggal,
            'jam'           => $request->jam,
            'matapelajaran' => $request->matapelajaran,
            'tahun'         => $request->tahun,
            'jurusan'       => $request->jurusan,
            'kursi'         => $request->kursi,
            'ruangan'       => $request->ruangan,
            'kelas'         => $kelas,
        ]);
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
