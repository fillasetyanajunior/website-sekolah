<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends AppController
{
    public function index()
    {
        $title      = 'Jurusan';
        $jurusan    = Department::paginate(10);
        return view('admin.jurusan.jurusan', compact('jurusan', 'title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jurusan' => 'required',
        ]);

        $int = '1234567890';
        $kode = substr(str_shuffle($int), 0, 2);

        Department::create([
            'kode'      => $kode,
            'jurusan'   => $request->jurusan,
        ]);
        return redirect()->back()->with('success', 'Data Berhasil Ditambahkan');
    }

    public function edit(Department $department)
    {
        return response()->json($department);
    }

    public function update(Request $request, Department $department)
    {
        Department::where('id', $department->id)
            ->update([
                'jurusan' => $request->jurusan,
            ]);
        return redirect()->back()->with('success', 'Data Berhasil Update');
    }

    public function destroy(Department $department)
    {
        Department::destroy($department->id);
        return redirect()->back()->with('success', 'Data Berhasil Delete');
    }
}
