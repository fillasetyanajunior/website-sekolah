<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Year;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class YearController extends AppController
{
    public function index()
    {
        $title  = 'Tahun Ajaran';
        $year   = Year::paginate(20);
        return view('admin.year.year', compact('year', 'title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tahun'     => 'required',
            'semester'  => 'required',
        ]);

        if ($request->semester == 1) {
            $semester = 'Ganjil';
        } else {
            $semester = 'Genap';
        }

        Year::create([
            'tahun'     => $request->tahun,
            'semester'  => $semester,
        ]);
        return redirect()->back()->with('success', 'Data Berhasil Ditambahkan');
    }

    public function edit(Request $request)
    {
        return response()->json(Year::find(Crypt::decrypt($request->year)));
    }

    public function update(Request $request)
    {
        if ($request->semester == 1) {
            $semester = 'Ganjil';
        } else {
            $semester = 'Genap';
        }

        Year::where('id', Crypt::decrypt($request->year))
            ->update([
                'tahun'     => $request->tahun,
                'semester'  => $semester,
            ]);
        return redirect()->back()->with('success', 'Data Berhasil Update');
    }

    public function destroy(Request $request)
    {
        Year::destroy(Crypt::decrypt($request->year));
        return redirect()->back()->with('success', 'Data Berhasil Delete');
    }
}
