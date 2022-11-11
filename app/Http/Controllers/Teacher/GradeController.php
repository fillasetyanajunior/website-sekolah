<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Imports\GradeImport;
use App\Models\Grade;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Maatwebsite\Excel\Facades\Excel;

class GradeController extends AppController
{
    public function index()
    {
        $title      = 'Nilai';
        $grade      = Grade::where('guru', Auth::user()->id_guru)->paginate(20);
        return view('teacher.grade.grade', compact('title', 'grade'));
    }

    public function store(Request $request)
    {
        Excel::import(new GradeImport(Auth::user()->id_guru), $request->import_excel);
        return redirect(route('teacher.grade'))->with('success', 'Data Berhasil Ditambahkan');
    }

    public function edit(Request $request)
    {
        return response()->json(Grade::find(Crypt::decrypt($request->grade)));
    }

    public function update(Request $request)
    {
        Grade::where('id', Crypt::decrypt($request->grade))
            ->update([
                'angka'         => $request->angka,
                'huruf'         => $request->huruf,
            ]);
        return redirect(route('teacher.grade'))->with('success', 'Data Berhasil Update');
    }

    public function destroy(Request $request)
    {
        Grade::destroy(Crypt::decrypt($request->grade));
        return redirect(route('teacher.grade'))->with('success', 'Data Berhasil Delete');
    }
}
