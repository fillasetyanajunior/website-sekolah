<?php

namespace App\Http\Controllers\Teacher;

use App\Exports\AttendanceRecapExport;
use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Department;
use App\Models\StudentDetail;
use App\Models\Teaching;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class AttendanceController extends AppController
{
    public function index()
    {
        $title      = 'Rekap Absen';
        $attendance = Attendance::where('guru', Auth::user()->id)->paginate(30);
        $subject    = Teaching::groupBy('matapelajaran')->where('id_guru', Auth::user()->id)->get('matapelajaran');
        $class      = Teaching::groupBy('kelas')->where('id_guru', Auth::user()->id)->get('kelas');
        $no_class   = Teaching::groupBy('no_kelas')->where('id_guru', Auth::user()->id)->get('no_kelas');
        $department = Teaching::groupBy('jurusan')->where('id_guru', Auth::user()->id)->get('jurusan');
        return view('teacher.attendance.attendance', compact('attendance', 'title', 'subject', 'class', 'no_class', 'department'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'matapelajaran' => 'required',

        ]);
    }

    public function show(Request $request)
    {
        if ($request->kelas == 1) {
            $kelas = 'X';
        }else if($request->kelas == 2){
            $kelas = 'XI';
        } else {
            $kelas = 'XII';
        }

        if ($kelas == 'X') {
            return Excel::download(new AttendanceRecapExport($request->matapelajaran, $kelas, Auth::user()->id_guru, $request->jurusa, $request->no_kelas), $request->matapelajaran . '_' . $kelas . '_' . $request->no_kelas . '.xlsx');
        } else {
            return Excel::download(new AttendanceRecapExport($request->matapelajaran, $kelas, Auth::user()->id_guru, $request->jurusa, $request->no_kelas), $request->matapelajaran . '_' . $kelas . '_' . $request->jurusan . '.xlsx');
        }

    }

    public function edit(Request $request)
    {
        # code...
    }

    public function update(Request $request)
    {
        # code...
    }

    public function destroy(Request $request)
    {
        # code...
    }

    public function student(Request $request)
    {
        if ($request->kelas == 'X') {
            return response()->json(StudentDetail::where('kelas', $request->kelas)->where('no_kelas', $request->no_kelas)->get('nama'));
        } else {
            $jurusan = Department::where('jurusan', $request->jurusan)->first()->id;
            return response()->json(StudentDetail::where('kelas', $request->kelas)->where('jurusan', $jurusan)->get('nama'));
        }
    }
}
