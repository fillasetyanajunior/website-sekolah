<?php

namespace App\Http\Controllers\Api\Student;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\QrCode;
use App\Models\Schedule;
use App\Models\StudentDetail;
use App\Models\Subject;
use App\Models\Year;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceApiController extends Controller
{
    public function absen(Request $request)
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
        $kode       = QrCode::where('kode', $request->kodeqr)->first();
        $student    = StudentDetail::find(Auth::user()->id_siswa);
        if ($student->kelas == 'X') {
            $schedule = Schedule::where('hari', $hari[date('N')])->where('jam_start', date('H:i:s'))->where('kelas', $student->kelas)->where('no_kelas', $student->no_kelas)->first();
        } else {
            $schedule = Schedule::where('hari', $hari[date('N')])->where('jam_start', date('H:i:s'))->where('kelas', $student->kelas)->where('jurusan', $student->jurusan)->first();
        }

        $year       = Year::find($schedule->tahun);
        $attendance = Attendance::where('id_siswa', $student->id)->where('tanggal', Carbon::now()->isoFormat('Y-M-d'))->first();

        if ($kode != null) {
            if ($kode->jurusan == $student->jurusan && $kode->kelas == $student->kelas && $kode->matapelajaran == $schedule->matapelajaran) {
                if ($attendance == null) {
                    Attendance::create([
                        'id_siswa'      => $student->id,
                        'nis'           => Auth::user()->username,
                        'matapelajaran' => $schedule->matapelajaran,
                        'jurusan'       => $student->jurusan,
                        'guru'          => $schedule->guru,
                        'tahun'         => $year->tahun,
                        'kelas'         => $student->kelas,
                        'tanggal'       => Carbon::now()->isoFormat('Y-M-d'),
                        'semester'      => $year->semester,
                        'jam'           => date('H:i:s'),
                        'keterangan'    => 'Hadir',
                    ]);

                    return response()->json(['status' => 'Absen Berhasil']);
                } else {
                    return response()->json(['status' => 'Anda Sudah Absen']);
                }
            } elseif ($kode->no_kelas == $student->no_kelas && $kode->kelas == $student->kelas && $kode->matapelajaran == $schedule->matapelajaran){
                if ($attendance == null) {
                    Attendance::create([
                        'id_siswa'      => $student->id,
                        'nis'           => Auth::user()->username,
                        'matapelajaran' => $schedule->matapelajaran,
                        'no_kelas'      => $student->no_kelas,
                        'guru'          => $schedule->guru,
                        'tahun'         => $year->tahun,
                        'kelas'         => $student->kelas,
                        'tanggal'       => Carbon::now()->isoFormat('Y-M-d'),
                        'semester'      => $year->semester,
                        'jam'           => date('H:i:s'),
                        'keterangan'    => 'Hadir',
                    ]);

                    return response()->json(['status' => 'Absen Berhasil']);
                } else {
                    return response()->json(['status' => 'Anda Sudah Absen']);
                }
            }else {
                return response()->json(['status' => 'Absen Gagal']);
            }
        } else {
            return response()->json(['status' => 'Absen Gagal']);
        }
    }

    public function show(Request $request)
    {
        if (request()->user()->currentAccessToken()->name != 'student') {
            return response()->json(['status' => 'error']);
        }
        $subject    = Attendance::groupBy('matapelajaran')->where('kelas', $request->kelas)->where('semester', $request->semester)->where('id_siswa', Auth::user()->id_siswa)->get('matapelajaran');
        $subjects   = Attendance::where('kelas', $request->kelas)->where('semester', $request->semester)->where('id_siswa', Auth::user()->id_siswa)->first();
        if ($subjects == null) {
            $response = [];
        } else {
            foreach ($subject as $showsubject) {
                $sakit      = Attendance::where('matapelajaran', $showsubject->matapelajaran)->where('keterangan', 'Sakit')->where('id_siswa', Auth::user()->id_siswa)->where('kelas', $request->kelas)->where('semester', $request->semester)->count();
                $hadir      = Attendance::where('matapelajaran', $showsubject->matapelajaran)->where('keterangan', 'Hadir')->where('id_siswa', Auth::user()->id_siswa)->where('kelas', $request->kelas)->where('semester', $request->semester)->count();
                $izin       = Attendance::where('matapelajaran', $showsubject->matapelajaran)->where('keterangan', 'Izin')->where('id_siswa', Auth::user()->id_siswa)->where('kelas', $request->kelas)->where('semester', $request->semester)->count();
                $alfa       = Attendance::where('matapelajaran', $showsubject->matapelajaran)->where('keterangan', 'Tanpa Keterangan')->where('id_siswa', Auth::user()->id_siswa)->where('kelas', $request->kelas)->where('semester', $request->semester)->count();
                $response[] = [
                    'matapelajran'  => Subject::find($showsubject->matapelajaran)->matapelajaran,
                    'sakit'         => $sakit,
                    'hadir'         => $hadir,
                    'izin'          => $izin,
                    'alfa'          => $alfa,
                ];
            }
        }

        return response()->json($response);
    }
}
