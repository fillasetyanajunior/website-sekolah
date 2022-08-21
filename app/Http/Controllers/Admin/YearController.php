<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Year;
use Illuminate\Http\Request;

class YearController extends AppController
{
    public function index()
    {
        $title  = 'Tahun Ajaran';
        $tahun  = Year::paginate(20);
        return view('admin.tahun.tahun', compact('tahun', 'title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tahun' => 'required',
        ]);

        Year::create([
            'tahun' => $request->tahun,
        ]);
        return redirect()->back()->with('success', 'Data Berhasil Ditambahkan');
    }

    public function edit(Year $year)
    {
        return response()->json($year);
    }

    public function update(Request $request, Year $year)
    {
        Year::where('id', $year->id)
            ->update([
                'tahun' => $request->tahun,
            ]);
        return redirect()->back()->with('success', 'Data Berhasil Update');
    }

    public function destroy(Year $year)
    {
        Year::destroy($year->id);
        return redirect()->back()->with('success', 'Data Berhasil Delete');
    }
}
