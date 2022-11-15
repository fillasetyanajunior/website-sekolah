<?php

namespace App\Http\Controllers\Admin;

use App\Exports\StudentExport;
use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Student;
use App\Models\StudentDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class StudentController extends AppController
{
    public function index()
    {
        $title      = 'Managemen Siswa';
        $student    = Student::paginate(20);
        $siswa      = StudentDetail::all();
        $department = Department::all();
        $class      = StudentDetail::groupBy('no_kelas')->get('no_kelas');
        return view('admin.managemen.student', compact('student', 'title', 'siswa', 'department', 'class'));
    }

    public function store(Request $request)
    {
        if ($request->name != null) {
            $request->validate([
                'name' => 'required',
            ]);

            $student = StudentDetail::where('nama', $request->name)->first();

            $int        = '1234567890';
            $password   = substr(str_shuffle($int), 0, 6);

            $ints       = '1234567890';
            $acak       = substr(str_shuffle($ints), 0, 6);
            $thn        = date('y');
            $username   = $thn . $acak;

            Student::create([
                'id_siswa'              => $student->id,
                'name'                  => $student->nama,
                'username'              => $username,
                'password'              => Hash::make($password),
                'password_encrypted'    => Crypt::encrypt($password),
            ]);
        } else {
            if ($request->kelas == 1) {
                $kelas = 'X';
            } elseif ($request->kelas == 2) {
                $kelas = 'XI';
            } else {
                $kelas = 'XII';
            }

            $student = StudentDetail::where('kelas', $kelas)->get();

            foreach ($student as $showstudent) {
                $user = Student::where('id_siswa', $showstudent->id)->first();
                if ($user == null) {
                    $int        = '1234567890';
                    $password   = substr(str_shuffle($int), 0, 6);

                    $ints       = '1234567890';
                    $acak       = substr(str_shuffle($ints), 0, 6);
                    $bln        = date('m') - 6;
                    if ($bln < 0) {
                        if ($showstudent->kelas == 'X') {
                            $thn = date('y', strtotime('+' . abs($bln) . 'month', strtotime('+1 year', strtotime('-1 year'))));
                        } elseif ($showstudent->kelas == 'XI') {
                            $thn = date('y', strtotime('+' . abs($bln) . 'month', strtotime('+1 year', strtotime('-2 year'))));
                        } else{
                            $thn = date('y', strtotime('+' . abs($bln) . 'month', strtotime('+1 year', strtotime('-3 year'))));
                        }
                    }else{
                        if ($showstudent->kelas == 'X') {
                            $thn = date('y', strtotime('-' . abs($bln) . 'month', strtotime('+1 year', strtotime('-1 year'))));
                        } elseif ($showstudent->kelas == 'XI') {
                            $thn = date('y', strtotime('-' . abs($bln) . 'month', strtotime('+1 year', strtotime('-2 year'))));
                        } else{
                            $thn = date('y', strtotime('-' . abs($bln) . 'month', strtotime('+1 year', strtotime('-3 year'))));
                        }
                    }

                    $username   = $thn . $acak;

                    Student::create([
                        'id_siswa'              => $showstudent->id,
                        'name'                  => $showstudent->nama,
                        'username'              => $username,
                        'password'              => Hash::make($password),
                        'password_encrypted'    => Crypt::encrypt($password),
                    ]);
                }
            }
        }

        return redirect()->back()->with('success', 'Data Berhasil Ditambahkan');
    }

    public function show(Request $request)
    {
        if ($request->kelas == 1) {
            $kelas = 'X';
        }else if ($request->kelas == 1) {
            $kelas = 'XI';
        } else {
            $kelas = 'XII';
        }

        if ($kelas == 'X') {
            return Excel::download(new StudentExport($kelas,$request->jurusan, $request->no_kelas), 'usernameStudent_' . $kelas . '_' . $request->no_kelas . '.xlsx');
        } else {
            return Excel::download(new StudentExport($kelas,$request->jurusan, $request->no_kelas), 'usernameStudent_' . $kelas . '_' . $request->jurusan . '.xlsx');
        }

    }

    public function edit(Request $request)
    {
        $student = Student::where('id_siswa', Crypt::decrypt($request->student))->first();
        return response()->json([
            'student'               => $student,
            'password_encrypted'    => Crypt::decrypt($student->password_encrypted),
        ]);
    }

    public function update(Request $request)
    {
        $student = Student::where('id_siswa', Crypt::decrypt($request->student))->first();
        Student::where('id', $student->id)
            ->update([
                'name'                  => $student->nama,
                'username'              => $student->username,
                'password'              => Hash::make($request->password),
                'password_encrypted'    => Crypt::encrypt($request->password),
            ]);
        return redirect()->back()->with('success', 'Data Berhasil Update');
    }

    public function destroy(Request $request)
    {
        Student::where('id_siswa', Crypt::decrypt($request->student))->delete();
        return redirect()->back()->with('success', 'Data Berhasil Delete');
    }
}
