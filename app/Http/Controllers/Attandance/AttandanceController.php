<?php

namespace App\Http\Controllers\Attandance;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Department;
use App\Models\Schedule;
use App\Models\Student;
use App\Models\StudentDetail;
use App\Models\Subject;
use App\Models\Year;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttandanceController extends Controller
{
    public function absen(Request $request)
    {
        $hari = array(
            1 =>    'Senin',
            'Selasa',
            'Rabu',
            'Kamis',
            'Jumat',
            'Sabtu',
            'Minggu'
        );

        $user       = Student::where('username', $request->nis)->first();
        $student    = StudentDetail::find($user->id_siswa);
        $attendance = Attendance::where('id_siswa', $student->id)->where('tanggal', date('Y-m-d'))->first();
        if ($student->kelas == 'X') {
            $schedule   = Schedule::where('kelas', $student->kelas)->where('matapelajaran', $request->matapelajaran)->where('no_kelas', $student->no_kelas)->first();
        } else {
            $jurusan    = Department::where('jurusan', $student->jurusan)->first();
            $schedule   = Schedule::where('kelas', $student->kelas)->where('matapelajaran', $request->matapelajaran)->where('jurusan', $jurusan->id)->first();
        }
        // if ($student->kelas == 'X') {
        //     $schedule   = Schedule::where('hari', $hari[date('N')])->where('kelas', $student->kelas)->where('matapelajaran', $request->matapelajaran)->where('no_kelas', $student->no_kelas)->first();
        // } else {
        //     $jurusan    = Department::where('jurusan', $student->jurusan)->first();
        //     $schedule   = Schedule::where('hari', $hari[date('N')])->where('kelas', $student->kelas)->where('matapelajaran', $request->matapelajaran)->where('jurusan', $jurusan->id)->first();
        // }

        $year       = Year::find($schedule->tahun);

        if ($request->keterangan == 'Izin') {
            $keterangan = 'Izin';
        } elseif ($request->keterangan == 'Tanpa Keterangan') {
            $keterangan = 'Tanpa Keterangan';
        } else {
            $keterangan = 'Hadir';
        }

        if ($attendance == null) {
            if ($student->kelas == 'X') {
                Attendance::create([
                    'id_siswa'      => $student->id,
                    'nis'           => $request->nis,
                    'matapelajaran' => $schedule->matapelajaran,
                    'no_kelas'      => $student->no_kelas,
                    'guru'          => $schedule->guru,
                    'tahun'         => $schedule->tahun,
                    'kelas'         => $student->kelas,
                    'tanggal'       => date('Y-m-d'),
                    'semester'      => $year->semester,
                    'jam'           => date('H:i:s'),
                    'keterangan'    => $keterangan,
                ]);
            } else {
                Attendance::create([
                    'id_siswa'      => $student->id,
                    'nis'           => $request->nis,
                    'matapelajaran' => $schedule->matapelajaran,
                    'jurusan'       => $student->jurusan,
                    'guru'          => $schedule->guru,
                    'tahun'         => $schedule->tahun,
                    'kelas'         => $student->kelas,
                    'tanggal'       => date('Y-m-d'),
                    'semester'      => $year->semester,
                    'jam'           => date('H:i:s'),
                    'keterangan'    => $keterangan,
                ]);
            }

            return response()->json(['status_code' => 200, 'nis' => $request->nis]);
        } else {
            return response()->json(['status_code' => 201, 'nis' => $request->nis]);
        }
    }
}
