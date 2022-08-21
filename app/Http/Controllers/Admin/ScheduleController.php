<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Schedule;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Year;
use Illuminate\Http\Request;

class ScheduleController extends AppController
{
    public function index()
    {
        $title      = 'Jadwal Pelajaran';
        $schedule   = Schedule::paginate(20);
        $subject    = Subject::all();
        $teacher    = Teacher::all();
        $year       = Year::all();
        $department = Department::all();
        return view('admin.jadwal.jadwal', compact('schedule', 'subject', 'teacher', 'year', 'department', 'title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'hari'          => 'required',
            'jam'           => 'required',
            'matapelajaran' => 'required',
            'guru'          => 'required',
            'tahun'         => 'required',
            'jurusan'       => 'required',
            'kelas'         => 'required',
        ]);

        if ($request->hari == 1) {
            $hari = 'senin';
        }elseif ($request->hari == 2) {
            $hari = 'selasa';
        }elseif ($request->hari == 3) {
            $hari = 'rabu';
        }elseif ($request->hari == 4) {
            $hari = 'kamis';
        }elseif ($request->hari == 5) {
            $hari = 'jum`at';
        }else {
            $hari = 'sabtu';
        }

        if ($request->jam == 1) {
            $jam = '1 Jam';
        }elseif ($request->jam == 2) {
            $jam = '2 Jam';
        }else {
            $jam = '3 Jam';
        }

        if ($request->kelas == 1) {
            $kelas = 'X';
        }elseif ($request->kelas == 2) {
            $kelas = 'XI';
        }else {
            $kelas = 'XII';
        }

        Schedule::create([
            'hari'          => $hari,
            'jam'           => $jam,
            'matapelajaran' => $request->matapelajaran,
            'guru'          => $request->guru,
            'tahun'         => $request->tahun,
            'jurusan'       => $request->jurusan,
            'kelas'         => $kelas,
        ]);

        return redirect()->back()->with('success', 'Data Berhasil Ditambahkan');
    }

    public function edit(Schedule $schedule)
    {
        if ($schedule->hari == 'senin') {
            $hari = 1;
        } elseif ($schedule->hari == 'selasa') {
            $hari = 2;
        } elseif ($schedule->hari == 'rabu') {
            $hari = 3;
        } elseif ($schedule->hari == 'kamis') {
            $hari = 4;
        } elseif ($schedule->hari == 'jum`at') {
            $hari = 5;
        } else {
            $hari = 6;
        }

        if ($schedule->jam == '1 Jam') {
            $jam = 1;
        } elseif ($schedule->jam == '2 Jam') {
            $jam = 2;
        } else {
            $jam = 3;
        }

        if ($schedule->kelas == 'X') {
            $kelas = 1;
        } elseif ($schedule->kelas == 'XII') {
            $kelas = 2;
        } else {
            $kelas = 3;
        }

        return response()->json([
            'hari'      => $hari,
            'jam'       => $jam,
            'kelas'     => $kelas,
            'schedule'  => $schedule
        ]);
    }

    public function update(Request $request, Schedule $schedule)
    {
        if ($request->hari == 1) {
            $hari = 'senin';
        }elseif ($request->hari == 2) {
            $hari = 'selasa';
        }elseif ($request->hari == 3) {
            $hari = 'rabu';
        }elseif ($request->hari == 4) {
            $hari = 'kamis';
        }elseif ($request->hari == 5) {
            $hari = 'jum`at';
        }else {
            $hari = 'sabtu';
        }

        if ($request->jam == 1) {
            $jam = '1 Jam';
        }elseif ($request->jam == 2) {
            $jam = '2 Jam';
        }else {
            $jam = '3 Jam';
        }

        if ($request->kelas == 1) {
            $kelas = 'X';
        }elseif ($request->kelas == 2) {
            $kelas = 'XI';
        }else {
            $kelas = 'XII';
        }

        Schedule::where('id', $schedule->id)
            ->update([
                'hari'          => $hari,
                'jam'           => $jam,
                'matapelajaran' => $request->matapelajaran,
                'guru'          => $request->guru,
                'tahun'         => $request->tahun,
                'jurusan'       => $request->jurusan,
                'kelas'         => $kelas,
            ]);
        return redirect()->back()->with('success', 'Data Berhasil Update');
    }

    public function destroy(Schedule $schedule)
    {
        Schedule::destroy($schedule->id);
        return redirect()->back()->with('success', 'Data Berhasil Delete');
    }
}
