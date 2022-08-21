<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\StudentDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class StudentController extends AppController
{
    public function index()
    {
        $title      = 'Managemen Siswa';
        $student    = Student::paginate(20);
        $siswa      = StudentDetail::all();
        return view('admin.managemen.siswa', compact('student', 'title', 'siswa'));
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

        Student::create([
            'name'                  => $request->name,
            'username'              => $username,
            'password'              => Hash::make($password),
            'password_encrypted'    => Crypt::encrypt($password),
        ]);

        return redirect()->back()->with('success', 'Data Berhasil Ditambahkan');
    }

    public function edit(Student $student)
    {
        return response()->json([
            'student'               => $student,
            'password_encrypted'    => Crypt::decrypt($student->password_encrypted),
        ]);
    }

    public function update(Request $request, Student $student)
    {
        Student::where('id', $student->id)
            ->update([
                'name'                  => $request->name,
                'username'              => $student->username,
                'password'              => Hash::make($request->password),
                'password_encrypted'    => Crypt::encrypt($request->password),
            ]);
        return redirect()->back()->with('success', 'Data Berhasil Update');
    }

    public function destroy(Student $student)
    {
        Student::destroy($student->id);
        return redirect()->back()->with('success', 'Data Berhasil Delete');
    }
}
