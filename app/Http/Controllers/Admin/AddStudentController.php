<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\StudentImport;
use App\Models\StudentDetail;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AddStudentController extends AppController
{
    public function index()
    {
        $title      = 'Input Siswa';
        $student    = StudentDetail::orderBy('nama')->paginate(20);
        return view('admin.inputdata.student', compact('title', 'student'));
    }

    public function store(Request $request)
    {
        Excel::import(new StudentImport, $request->import_excel);
        return redirect(route('admin.input-student'))->with('success', 'Data Berhasil Ditambahkan');
    }

    public function destroy(StudentDetail $studentDetail)
    {
        StudentDetail::destroy($studentDetail->id);
        return redirect(route('admin.input-student'))->with('success', 'Data Berhasil Dihapus');
    }
}
