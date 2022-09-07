<?php

namespace App\Http\Controllers\Library;

use App\Http\Controllers\Controller;
use App\Models\Lending;
use App\Models\Student;
use Illuminate\Http\Request;

class LendingController extends AppController
{
    public function index()
    {
        $title = 'Peminjaman Buku';
        $lending = Lending::paginate(20);
        $student = Student::all();
        return view('library.lending.lending',compact('title','lending','student'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_buku'             => 'required',
            'siswa'                 => 'required',
            'tanggal_peminjaman'    => 'required',
            'tanggal_pengembalian'  => 'required',
        ]);

        Lending::create([
            'id_siswa'              => $request->siswa,
            'kode_buku'             => $request->kode_buku,
            'tanggal_peminjaman'    => $request->tanggal_peminjaman,
            'tanggal_pengembalian'  => $request->tanggal_pengembalian,
        ]);

        return redirect()->back()->with('success', 'Data Berhasil Ditambahkan');
    }

    public function edit(Lending $lending)
    {
        return response()->json($lending);
    }

    public function update(Request $request, Lending $lending)
    {
        Lending::where('id', $lending->id)
                ->update([
                    'id_siswa'              => $request->siswa,
                    'kode_buku'             => $request->kode_buku,
                    'tanggal_peminjaman'    => $request->tanggal_peminjaman,
                    'tanggal_pengembalian'  => $request->tanggal_pengembalian,
                ]);

        return redirect()->back()->with('success', 'Data Berhasil Diubah');
    }

    public function destroy(Lending $lending)
    {
        Lending::destroy($lending->id);
        return redirect()->back()->with('success','Data Berhasil Dihapus');
    }
}
