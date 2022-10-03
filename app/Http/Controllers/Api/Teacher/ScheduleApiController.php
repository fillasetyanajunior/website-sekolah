<?php

namespace App\Http\Controllers\Api\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Schedule;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduleApiController extends Controller
{
    public function index(Request $request)
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
        $mapel      = Subject::where('matapelajaran', $request->matapelajaran)->first();
        $jurusan    = Department::where('jurusan', $request->jurusan)->first();
        $jadwal     = Schedule::where('guru', Auth::user()->id_guru)->where('kelas', $request->kelas)->where('matapelajaran', $mapel->id)
                              ->where('jurusan', $jurusan->id)->where('hari', $hari[date('N')])->first();
        if ($jadwal == null) {
            return response()->json([
                'jam'       => null,
                'jam_end'   => null,
            ]);
        } else {
            $time = (int)(strtotime($jadwal->jam_end) - strtotime($jadwal->jam_start)) / (60 / 60);
            $times = gmdate('H', $time) . ':' . gmdate('i',$time) . ':' . gmdate('s', $time);
            return response()->json([
                'jam'       => $times,
                'jam_end'   => $jadwal->jam_end,
            ]);
        }
    }
}
