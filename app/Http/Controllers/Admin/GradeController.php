<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\GradeImport;
use App\Models\Grade;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class GradeController extends AppController
{
    public function index()
    {
        $title      = 'Nilai';
        $teacher    = Teacher::all();
        $grade      = Grade::paginate(20);
        return view('admin.nilai.nilai', compact('title', 'grade', 'teacher'));
    }

    public function store(Request $request)
    {
        Excel::import(new GradeImport($request->guru), $request->import_excel);
        return redirect(route('admin.grade'))->with('success', 'Data Berhasil Ditambahkan');
    }

    public function edit(Grade $grade)
    {
        return response()->json($grade);
    }

    public function update(Request $request, Grade $grade)
    {
        Grade::where('id', $grade->id)
            ->update([
                'angka'         => $request->angka,
                'huruf'         => $request->huruf,
            ]);
        return redirect(route('admin.grade'))->with('success', 'Data Berhasil Update');
    }

    public function destroy(Grade $grade)
    {
        Grade::destroy($grade->id);
        return redirect(route('admin.grade'))->with('success', 'Data Berhasil Delete');
    }
}
