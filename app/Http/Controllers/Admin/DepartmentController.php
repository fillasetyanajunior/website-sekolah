<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class DepartmentController extends AppController
{
    public function index()
    {
        $title      = 'Jurusan';
        $department = Department::paginate(10);
        return view('admin.department.department', compact('department', 'title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jurusan' => 'required',
        ]);

        Department::create([
            'jurusan' => $request->jurusan,
        ]);
        return redirect()->back()->with('success', 'Data Berhasil Ditambahkan');
    }

    public function edit(Request $request)
    {
        return response()->json(Department::find(Crypt::decrypt($request->department)));
    }

    public function update(Request $request)
    {
        Department::where('id', Crypt::decrypt($request->department))
            ->update([
                'jurusan' => $request->jurusan,
            ]);
        return redirect()->back()->with('success', 'Data Berhasil Update');
    }

    public function destroy(Request $request)
    {
        Department::destroy(Crypt::decrypt($request->department));
        return redirect()->back()->with('success', 'Data Berhasil Delete');
    }
}
