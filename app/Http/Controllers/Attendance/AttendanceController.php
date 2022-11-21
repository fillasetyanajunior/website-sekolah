<?php

namespace App\Http\Controllers\Attendance;

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
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;

class AttendanceController extends Controller
{
    public function absen(Request $request)
    {
        $hari = array(
            1 =>    'Senin',
            'Selasa',
            'Rabu',
            'Kamis',
            'Jum`at',
            'Sabtu',
            'Minggu'
        );

        $user       = Student::where('username', $request->nis)->first();
        $student    = StudentDetail::find($user->id_siswa);
        $attendance = Attendance::where('id_siswa', $student->id)->where('tanggal', date('Y-m-d'))->first();
        // if ($student->kelas == 'X') {
        //     $schedule   = Schedule::where('kelas', $student->kelas)->where('matapelajaran', $request->matapelajaran)->where('no_kelas', $student->no_kelas)->first();
        // } else {
        //     $schedule   = Schedule::where('kelas', $student->kelas)->where('matapelajaran', $request->matapelajaran)->where('jurusan', $student->jurusan)->first();
        // }
        if ($student->kelas == 'X') {
            $schedule   = Schedule::where('hari', Str::lower($hari[date('N')]))->where('kelas', $student->kelas)->where('matapelajaran', Crypt::decrypt($request->matapelajaran))->where('guru', Crypt::decrypt($request->guru))->where('no_kelas', $student->no_kelas)->first();
        } else {
            $schedule   = Schedule::where('hari', Str::lower($hari[date('N')]))->where('kelas', $student->kelas)->where('matapelajaran', Crypt::decrypt($request->matapelajaran))->where('guru', Crypt::decrypt($request->guru))->where('jurusan', $student->jurusan)->first();
        }

        $year = Year::find($schedule->tahun);

        if ($request->keterangan == 1) {
            $keterangan = 'Izin';
        } elseif ($request->keterangan == 2) {
            $keterangan = 'Tanpa Keterangan';
        } elseif ($request->keterangan == 3) {
            $keterangan = 'Sakit';
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
                    'tahun'         => $year->tahun,
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
                    'tahun'         => $year->tahun,
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
    public function absenall(Request $request)
    {
        $hari = array(
            1 =>    'Senin',
            'Selasa',
            'Rabu',
            'Kamis',
            'Jum`at',
            'Sabtu',
            'Minggu'
        );

        if ($request->kelas == 'X') {
            $student    = StudentDetail::where('kelas', $request->kelas)->where('no_kelas', $request->no_kelas)->get();
            $schedule   = Schedule::where('hari', $hari[date('N')])->where('kelas', $request->kelas)->where('matapelajaran', Crypt::decrypt($request->matapelajaran))->where('guru', Crypt::decrypt($request->guru))->where('no_kelas', $request->no_kelas)->first();
            // $schedule   = Schedule::where('kelas', $request->kelas)->where('matapelajaran', $request->matapelajaran)->where('no_kelas', $request->no_kelas)->first();
        } else {
            $student    = StudentDetail::where('kelas', $request->kelas)->where('jurusan', Crypt::decrypt($request->jurusan))->get();
            $schedule   = Schedule::where('hari', $hari[date('N')])->where('kelas', $request->kelas)->where('matapelajaran', Crypt::decrypt($request->matapelajaran))->where('guru', Crypt::decrypt($request->guru))->where('jurusan', Crypt::decrypt($request->jurusan))->first();
            // $schedule   = Schedule::where('kelas', $request->kelas)->where('matapelajaran', $request->matapelajaran)->where('jurusan', $request->jurusan)->first();
        }

        $year = Year::find($schedule->tahun);

        if (Student::where('id_siswa', $student[0]->id)->first() != null) {
            foreach ($student as $showstudent) {
                if ($showstudent->kelas == 'X') {
                    $attendance = Attendance::where('id_siswa', $showstudent->id)->where('tanggal', date('Y-m-d'))->where('kelas', $schedule->kelas)->where('guru', $schedule->guru)->where('matapelajaran', $schedule->matapelajaran)->where('no_kelas', $schedule->no_kelas)->first();
                } else {
                    $attendance = Attendance::where('id_siswa', $showstudent->id)->where('tanggal', date('Y-m-d'))->where('kelas', $schedule->kelas)->where('guru', $schedule->guru)->where('matapelajaran', $schedule->matapelajaran)->where('jurusan', $schedule->jurusan)->first();
                }

                if ($attendance == null) {
                    if ($request->kelas == 'X') {
                        Attendance::create([
                            'id_siswa'      => $showstudent->id,
                            'nis'           => Student::where('id_siswa', $showstudent->id)->first()->username,
                            'matapelajaran' => $schedule->matapelajaran,
                            'no_kelas'      => $request->no_kelas,
                            'guru'          => $schedule->guru,
                            'tahun'         => $year->tahun,
                            'kelas'         => $request->kelas,
                            'tanggal'       => date('Y-m-d'),
                            'semester'      => $year->semester,
                            'jam'           => date('H:i:s'),
                            'keterangan'    => 'Hadir',
                        ]);
                    } else {
                        Attendance::create([
                            'id_siswa'      => $showstudent->id,
                            'nis'           => Student::where('id_siswa', $showstudent->id)->first()->username,
                            'matapelajaran' => $schedule->matapelajaran,
                            'jurusan'       => Crypt::decrypt($request->jurusan),
                            'guru'          => $schedule->guru,
                            'tahun'         => $year->tahun,
                            'kelas'         => $request->kelas,
                            'tanggal'       => date('Y-m-d'),
                            'semester'      => $year->semester,
                            'jam'           => date('H:i:s'),
                            'keterangan'    => 'Hadir',
                        ]);
                    }
                }
            }
            return response()->json(['status_code' => 200]);
        } else {
            return response()->json(['status_code' => 500]);
        }
    }

    public function edit(Request $request)
    {
        $attendance = Attendance::find(Crypt::decrypt($request->id));
        return response()->json([
            'id'            => $request->id,
            'nis'           => $attendance->nis,
            'keterangan'    => $attendance->keterangan,
        ]);
    }

    public function update(Request $request)
    {
        if ($request->keterangan == 1) {
            $keterangan = 'Izin';
        } elseif ($request->keterangan == 2) {
            $keterangan = 'Tanpa Keterangan';
        } elseif ($request->keterangan == 3) {
            $keterangan = 'Sakit';
        } else {
            $keterangan = 'Hadir';
        }

        Attendance::where('id', Crypt::decrypt($request->id))
                ->update([
                    'keterangan' => $keterangan,
                ]);

        return response()->json(['status_code' => 200]);
    }
}
