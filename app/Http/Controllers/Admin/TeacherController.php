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
        return view('admin.managemen.teacher', compact('teacher', 'title', 'guru'));
    }

    public function store(Request $request)
    {
        if ($request->name != null) {
            $request->validate([
                'name' => 'required',
            ]);

            $int        = '1234567890';
            $password   = substr(str_shuffle($int), 0, 6);

            $ints       = '1234567890';
            $acak       = substr(str_shuffle($ints), 0, 5);
            $thn        = date('ymd');
            $username   = $thn . $acak;

            $teacher = TeacherDetail::where('nama', $request->name)->first();

            Teacher::create([
                'id_guru'               => $teacher->id,
                'name'                  => $teacher->nama,
                'username'              => $username,
                'password'              => Hash::make($password),
                'role'                  => $teacher->wali_kelas == null ? $teacher->jabatan : 'Wali Kelas',
                'password_encrypted'    => Crypt::encrypt($password),
            ]);
        }else {
            $teacher = TeacherDetail::all();

            foreach ($teacher as $showteacher) {
                $int        = '1234567890';
                $password   = substr(str_shuffle($int), 0, 6);

                $ints       = '1234567890';
                $acak       = substr(str_shuffle($ints), 0, 5);
                $thn        = date('ymd');
                $username   = $thn . $acak;

                Teacher::create([
                    'id_guru'               => $showteacher->id,
                    'name'                  => $showteacher->nama,
                    'username'              => $username,
                    'password'              => Hash::make($password),
                    'role'                  => $showteacher->wali_kelas == null ? $showteacher->jabatan : 'Wali Kelas',
                    'password_encrypted'    => Crypt::encrypt($password),
                ]);
            }
        }

        return redirect()->back()->with('success', 'Data Berhasil Ditambahkan');
    }

    public function edit(Request $request)
    {
        $teacher = Teacher::find(Crypt::decrypt($request->teacher));
        return response()->json([
            'teacher'               => $teacher,
            'password_encrypted'    => Crypt::decrypt($teacher->password_encrypted),
        ]);
    }

    public function update(Request $request)
    {
        $teacher = TeacherDetail::find(Crypt::decrypt($request->teacher));

        Teacher::where('id', $teacher->id)
            ->update([
                'name'                  => $teacher->nama,
                'username'              => $teacher->username,
                'password'              => Hash::make($request->password),
                'password_encrypted'    => Crypt::encrypt($request->password),
            ]);
        return redirect()->back()->with('success', 'Data Berhasil Update');
    }

    public function destroy(Request $request)
    {
        Teacher::destroy(Crypt::decrypt($request->teacher));
        return redirect()->back()->with('success', 'Data Berhasil Delete');
    }
}
