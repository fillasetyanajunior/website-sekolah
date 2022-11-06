<?php

namespace App\Http\Controllers\Attandance;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Department;
use App\Models\MaterialInput;
use App\Models\Schedule;
use App\Models\Teaching;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends AppController
{
    public function index()
    {
        $title      = 'Informasi';
        return view('attandance.splash', compact('title'));
    }

    public function dashboard(Request $request)
    {
        $request->only('id');
        $title      = 'Dashboard';
        $material   = MaterialInput::find($request->id);
        $hari       = array(1 =>
                        'Senin',
                        'Selasa',
                        'Rabu',
                        'Kamis',
                        'Jum`at',
                        'Sabtu',
                        'Minggu'
                    );
        // if ($material->kelas == 'X') {
        //     $schedule = Schedule::where('guru', Auth::user()->id_guru)->where('kelas', $material->kelas)->where('matapelajaran', $material->matapelajaran)
        //                         ->where('no_kelas', $material->no_kelas)->get();
        // } else {
        //     $schedule = Schedule::where('guru', Auth::user()->id_guru)->where('kelas', $material->kelas)->where('matapelajaran', $material->matapelajaran)
        //                         ->where('jurusan', $material->jurusan)->get();
        // }
        if ($material->kelas == 'X') {
            $schedule = Schedule::where('guru', Auth::user()->id_guru)->where('kelas', $material->kelas)->where('matapelajaran', $material->matapelajaran)
                                ->where('no_kelas', $material->no_kelas)->where('hari', $hari[date('N')])->get();
        } else {
            $schedule = Schedule::where('guru', Auth::user()->id_guru)->where('kelas', $material->kelas)->where('matapelajaran', $material->matapelajaran)
                                ->where('jurusan', $material->jurusan)->where('hari', $hari[date('N')])->get();
        }

        if (count($schedule) == 1) {
            $jam_start  = $schedule[0]->jam_start;
            $jam_end    = $schedule[0]->jam_end;
        }elseif (count($schedule) == 2) {
            $jam_start  = $schedule[0]->jam_start;
            $jam_end    = $schedule[1]->jam_end;
        } else {
            $jam_start  = $schedule[0]->jam_start;
            $jam_end    = $schedule[2]->jam_end;
        }

        $studentcount   = Attendance::where('kelas', $material->kelas)->where('matapelajaran', $material->matapelajaran)->where('tanggal', date('Y-m-d'))->count();
        $students       = Attendance::where('kelas', $material->kelas)->where('matapelajaran', $material->matapelajaran)->where('tanggal', date('Y-m-d'))->get();

        return view('attandance.dashboard', compact('title', 'material', 'jam_start', 'jam_end', 'schedule', 'hari', 'studentcount', 'students'));
    }
}
