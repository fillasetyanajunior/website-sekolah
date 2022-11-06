<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
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

            $student = StudentDetail::find($request->name);

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

            if ($kelas == 'X') {
                $request->validate([
                    'kelas'     => 'required',
                    'no_kelas'  => 'required',
                ]);
                $student = StudentDetail::where('kelas', $kelas)->where('no_kelas', $request->no_kelas)->get();
            } else {
                $request->validate([
                    'kelas'     => 'required',
                    'jurusan'   => 'required',
                ]);
                $student = StudentDetail::where('kelas', $kelas)->where('jurusan', $request->jurusan)->get();
            }

            foreach ($student as $showstudent) {
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
        $student = StudentDetail::find($request->name);

        Student::where('id', $student->id)
            ->update([
                'name'                  => $student->nama,
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
