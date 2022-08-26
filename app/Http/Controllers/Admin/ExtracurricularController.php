<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\ExtracurricularImport;
use App\Models\Extracurricular;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExtracurricularController extends Controller
{
    public function index()
    {
        $title      = 'Nilai Ekstrakulikuler';
        $extra      = Extracurricular::paginate(20);
        return view('admin.extracurricular.extracurricular', compact('title', 'extra'));
    }

    public function store(Request $request)
    {
        Excel::import(new ExtracurricularImport($request->guru), $request->import_excel);
        return redirect(route('admin.extracurricular'))->with('success', 'Data Berhasil Ditambahkan');
    }

    public function edit(Extracurricular $extracurricular)
    {
        return response()->json($extracurricular);
    }

    public function update(Request $request, Extracurricular $extracurricular)
    {
        Extracurricular::where('id', $extracurricular->id)
            ->update([
                'angka'         => $request->angka,
                'huruf'         => $request->huruf,
            ]);
        return redirect(route('admin.extracurricular'))->with('success', 'Data Berhasil Update');
    }

    public function destroy(Extracurricular $extracurricular)
    {
        Extracurricular::destroy($extracurricular->id);
        return redirect(route('admin.extracurricular'))->with('success', 'Data Berhasil Delete');
    }
}
