<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\TeacherImport;
use App\Models\TeacherDetail;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AddTeacherController extends AppController
{
    public function index()
    {
        $title = 'Input Guru';
        $teacher = TeacherDetail::orderBy('nama')->paginate(20);
        return view('admin.inputdata.teacher', compact('title', 'teacher'));
    }

    public function store(Request $request)
    {
        Excel::import(new TeacherImport($request->guru), $request->import_excel);
        return redirect(route('admin.input-teacher'))->with('success', 'Data Berhasil Ditambahkan');
    }

    public function destroy(TeacherDetail $teacherDetail)
    {
        TeacherDetail::destroy($teacherDetail->id);
        return redirect(route('admin.input-teacher'))->with('success', 'Data Berhasil Dihapus');
    }
}
