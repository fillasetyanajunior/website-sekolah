<?php

namespace App\Http\Controllers\Api\Student;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\QrCode;
use App\Models\Schedule;
use App\Models\StudentDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceApiController extends Controller
{
    public function absenmobile(Request $request)
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
        $kode       = QrCode::where('kode', $request->kodeqr)->first();
        $student    = StudentDetail::find(Auth::user()->id_siswa);
        $schedule   = Schedule::where('hari', $hari[date('N')])->where('jam_start', date('H:i:s'))->where('kelas', $student->kelas)->where('jurusan', $student->jurusan)->first();
        $attendance = Attendance::where('id_siswa', $student->id)->where('tanggal', Carbon::now()->isoFormat('Y:m:d'))->first();

        if ($kode != null) {
            if ($kode->jurusan == $student->jurusan && $kode->kelas == $student->kelas && $kode->matapelajaran == $schedule->matapelajaran) {
                if ($attendance == null) {
                    Attendance::create([
                        'id_siswa'      => $student->id,
                        'nis'           => Auth::user()->username,
                        'matapelajaran' => $schedule->matapelajaran,
                        'guru'          => $schedule->guru,
                        'tahun'         => $schedule->matapelajaran,
                        'kelas'         => $student->kelas,
                        'tanggal'       => Carbon::now()->isoFormat('Y:m:d'),
                        'jam'           => date('H:i:s'),
                    ]);

                    return response()->json(['status' => 'Absen Berhasil']);
                } else {
                    return response()->json(['status' => 'Anda Sudah Absen']);
                }
            } else {
                return response()->json(['status' => 'Absen Gagal']);
            }
        } else {
            return response()->json(['status' => 'Absen Gagal']);
        }
    }
}
