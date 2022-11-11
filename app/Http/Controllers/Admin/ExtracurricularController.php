<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\ExtracurricularImport;
use App\Models\Extracurricular;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Maatwebsite\Excel\Facades\Excel;

class ExtracurricularController extends AppController
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

    public function edit(Request $request)
    {
        return response()->json(Extracurricular::find(Crypt::decrypt($request->extracurricular)));
    }

    public function update(Request $request)
    {
        Extracurricular::where('id', Crypt::decrypt($request->extracurricular))
            ->update([
                'angka'         => $request->angka,
                'huruf'         => $request->huruf,
            ]);
        return redirect(route('admin.extracurricular'))->with('success', 'Data Berhasil Update');
    }

    public function destroy(Request $request)
    {
        Extracurricular::destroy(Crypt::decrypt($request->extracurricular));
        return redirect(route('admin.extracurricular'))->with('success', 'Data Berhasil Delete');
    }
}
