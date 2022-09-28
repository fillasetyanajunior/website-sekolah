<?php

namespace App\Http\Controllers\Api\Student;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\StudentDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduleApiController extends Controller
{
    public function jadwal()
    {
        if (request()->user()->currentAccessToken()->name != 'student') {
            return response()->json(['status' => 'error']);
        }

        $hari = array(
            1 =>
            'Senin',
            'Selasa',
            'Rabu',
            'Kamis',
            'Jumat',
            'Sabtu',
            'Minggu'
        );
        $student    = StudentDetail::find(Auth::user()->id_siswa);
        $schedule   = Schedule::orderBy('schedules.jam_start')
                                 ->join('subjects', 'subjects.id', '=', 'schedules.matapelajaran')
                                 ->join('years', 'years.id', '=', 'schedules.tahun')
                                 ->join('teacher_details', 'teacher_details.id', '=', 'schedules.guru')
                                 ->join('departments', 'departments.id', '=', 'schedules.jurusan')
                                ->where('schedules.kelas', $student->kelas)->where('schedules.jurusan', $student->jurusan)->where('hari', $hari[date('N')])
                               ->select('schedules.id', 'schedules.hari', 'schedules.jam_start', 'schedules.jam_end', 'subjects.matapelajaran', 'teacher_details.nama as guru', 'years.tahun', 'departments.jurusan', 'schedules.kelas')->get();
        return response()->json($schedule);
    }

    public function show()
    {
        if (request()->user()->currentAccessToken()->name != 'student') {
            return response()->json(['status' => 'error']);
        }

        $student    = StudentDetail::find(Auth::user()->id_siswa);
        $schedule   = Schedule::orderBy('schedules.jam_start')->orderBy('schedules.hari')
                                 ->join('subjects', 'subjects.id', '=', 'schedules.matapelajaran')
                                 ->join('years', 'years.id', '=', 'schedules.tahun')
                                 ->join('teacher_details', 'teacher_details.id', '=', 'schedules.guru')
                                 ->join('departments', 'departments.id', '=', 'schedules.jurusan')
                                ->where('schedules.kelas', $student->kelas)->where('schedules.jurusan', $student->jurusan)
                               ->select('schedules.id', 'schedules.hari', 'schedules.jam_start', 'schedules.jam_end', 'subjects.matapelajaran', 'teacher_details.nama as guru', 'years.tahun', 'departments.jurusan', 'schedules.kelas')->get();
        return response()->json($schedule);
    }
}
