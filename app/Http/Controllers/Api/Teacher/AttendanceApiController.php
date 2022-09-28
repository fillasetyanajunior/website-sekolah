<?php

namespace App\Http\Controllers\Api\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Department;
use App\Models\QrCode;
use App\Models\Schedule;
use App\Models\Student;
use App\Models\StudentDetail;
use App\Models\Subject;
use App\Models\Year;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceApiController extends Controller
{
    public function absendekstop(Request $request)
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
        $mapel      = Subject::where('matapelajaran', $request->matapelajaran)->first();
        $jurusan    = Department::where('jurusan', $request->jurusan)->first();
        $schedule   = Schedule::where('hari', $hari[date('N')])->where('kelas', $student->kelas)->where('matapelajaran', $mapel->id)->where('jurusan', $jurusan->id)->first();
        $year       = Year::find($schedule->tahun);

        if ($request->keterangan == 'Izin') {
            $keterangan = 'Izin';
        }elseif ($request->keterangan == 'Tanpa Keterangan') {
            $keterangan = 'Tanpa Keterangan';
        }else{
            $keterangan = 'Hadir';
        }

        if ($attendance == null) {
            Attendance::create([
                'id_siswa'      => $student->id,
                'nis'           => Auth::user()->username,
                'matapelajaran' => $schedule->matapelajaran,
                'jurusan'       => $student->jurusan,
                'guru'          => $schedule->guru,
                'tahun'         => $schedule->tahun,
                'kelas'         => $student->kelas,
                'tanggal'       => Carbon::now()->isoFormat('Y-M-d'),
                'semester'      => $year->semester,
                'jam'           => date('H:i:s'),
                'keterangan'    => 'Hadir',
            ]);

            return response()->json(['status_code' => 200, 'nis' => $request->nis]);
        } else {
            return response()->json(['status_code' => 201, 'nis' => $request->nis]);
        }
    }

    public function show(Request $request)
    {
        $mapel      = Subject::where('matapelajaran', $request->matapelajaran)->first();
        $jurusan    = Department::where('jurusan', $request->jurusan)->first();
        $attendance = Attendance::join('student_details', 'student_details.id','=','attendances.id_siswa')
                                ->where('matapelajaran', $mapel->id)
                                ->where('attendances.jurusan',$jurusan->id)
                                ->where('attendances.kelas',$request->kelas)
                                ->where('guru', Auth::user()->id)
                                ->where('tanggal',date('Y-m-d'))
                                ->select('attendances.*', 'student_details.nama')
                                ->get();
        return response()->json($attendance);
    }

    public function destroy(Attendance $attendance)
    {
        Attendance::destroy($attendance->id);
        return response()->json(['status_code' => 200]);
    }
}
