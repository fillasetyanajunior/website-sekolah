<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\TeacherDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class TeacherController extends AppController
{
    public function index()
    {
        $title      = 'Managemen Guru';
        $teacher    = Teacher::paginate(20);
        $guru       = TeacherDetail::all();
        return view('admin.managemen.guru',compact('teacher', 'title', 'guru'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $int        = '1234567890';
        $password   = substr(str_shuffle($int), 0, 6);

        $ints       = '1234567890';
        $acak       = substr(str_shuffle($ints), 0, 5);
        $thn        = date('ymd');
        $username   = $thn . $acak;

        Teacher::create([
            'name'                  => $request->name,
            'username'              => $username,
            'password'              => Hash::make($password),
            'password_encrypted'    => Crypt::encrypt($password),
        ]);

        return redirect()->back()->with('success', 'Data Berhasil Ditambahkan');
    }

    public function edit(Teacher $teacher)
    {
        return response()->json([
            'teacher'               => $teacher,
            'password_encrypted'    => Crypt::decrypt($teacher->password_encrypted),
        ]);
    }

    public function update(Request $request, Teacher $teacher)
    {
        Teacher::where('id', $teacher->id)
            ->update([
                'name'                  => $request->name,
                'username'              => $teacher->username,
                'password'              => Hash::make($request->password),
                'password_encrypted'    => Crypt::encrypt($request->password),
            ]);
        return redirect()->back()->with('success', 'Data Berhasil Update');
    }

    public function destroy(Teacher $teacher)
    {
        Teacher::destroy($teacher->id);
        return redirect()->back()->with('success', 'Data Berhasil Delete');
    }
}
