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
        return view('admin.schedule.schedule', compact('schedule', 'subject', 'teacher', 'year', 'department', 'title'));
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

        if ($request->kelas == 1) {
            $kelas = 'X';
        }elseif ($request->kelas == 2) {
            $kelas = 'XI';
        }else {
            $kelas = 'XII';
        }

        for ($i = 0; $i < count($request->matapelajaran); $i++){

            if ($request->jam[$i] == 1) {

                $schedule = Schedule::orderBy('jam_end', 'DESC')->where('hari', $hari)->where('kelas', $kelas)->where('jurusan', $request->jurusan)->first();

                if ($schedule == null) {
                    $start  = date('H:i:s', strtotime('07:00'));
                } else {
                    $start  = date('H:i:s', strtotime($schedule->jam_end));
                }

                $end = date('H:i:s', strtotime('+45 minutes', strtotime($start)));

                if ($start > date('H:i:s', strtotime('10:30')) && $start < date('H:i:s', strtotime('11:00'))) {
                    $ist1 = Subject::where('matapelajaran', 'Istirahat 1')->first();
                    Schedule::create([
                        'hari'          => $hari,
                        'jam_start'     => date('H:i:s', strtotime($start)),
                        'jam_end'       => date('H:i:s', strtotime('+30 minutes', strtotime($start))),
                        'matapelajaran' => $ist1->id,
                        'guru'          => 0,
                        'tahun'         => $request->tahun,
                        'jurusan'       => $request->jurusan,
                        'kelas'         => $kelas,
                    ]);
                } elseif ($start > date('H:i:s', strtotime('12:00')) && $start < date('H:i:s', strtotime('13:00'))) {
                    $ist2 = Subject::where('matapelajaran', 'Istirahat 2')->first();
                    Schedule::create([
                        'hari'          => $hari,
                        'jam_start'     => date('H:i:s', strtotime($start)),
                        'jam_end'       => date('H:i:s', strtotime('+1 hours', strtotime($start))),
                        'matapelajaran' => $ist2->id,
                        'guru'          => 0,
                        'tahun'         => $request->tahun,
                        'jurusan'       => $request->jurusan,
                        'kelas'         => $kelas,
                    ]);
                }else{
                    Schedule::create([
                        'hari'          => $hari,
                        'jam_start'     => $start,
                        'jam_end'       => $end,
                        'matapelajaran' => $request->matapelajaran[$i],
                        'guru'          => $request->guru[$i],
                        'tahun'         => $request->tahun,
                        'jurusan'       => $request->jurusan,
                        'kelas'         => $kelas,
                    ]);
                }

            } else if ($request->jam[$i] == 2) {

                for ($j = 0; $j < 2; $j) {
                    $schedule = Schedule::orderBy('jam_end', 'DESC')->where('hari', $hari)->where('kelas', $kelas)->where('jurusan', $request->jurusan)->first();

                    if ($schedule == null) {
                        $start  = date('H:i:s', strtotime('07:00'));
                    } else {
                        $start  = date('H:i:s', strtotime($schedule->jam_end));
                    }

                    $end = date('H:i:s', strtotime('+45 minutes', strtotime($start)));

                    if ($start > date('H:i:s', strtotime('10:30')) && $start < date('H:i:s', strtotime('11:00'))) {
                        $ist1 = Subject::where('matapelajaran', 'Istirahat 1')->first();
                        Schedule::create([
                            'hari'          => $hari,
                            'jam_start'     => date('H:i:s', strtotime($start)),
                            'jam_end'       => date('H:i:s', strtotime('+30 minutes', strtotime($start))),
                            'matapelajaran' => $ist1->id,
                            'guru'          => 0,
                            'tahun'         => $request->tahun,
                            'jurusan'       => $request->jurusan,
                            'kelas'         => $kelas,
                        ]);
                    } elseif ($start > date('H:i:s', strtotime('12:00')) && $start < date('H:i:s', strtotime('13:00'))) {
                        $ist2 = Subject::where('matapelajaran', 'Istirahat 2')->first();
                        Schedule::create([
                            'hari'          => $hari,
                            'jam_start'     => date('H:i:s', strtotime($start)),
                            'jam_end'       => date('H:i:s', strtotime('+1 hours', strtotime($start))),
                            'matapelajaran' => $ist2->id,
                            'guru'          => 0,
                            'tahun'         => $request->tahun,
                            'jurusan'       => $request->jurusan,
                            'kelas'         => $kelas,
                        ]);
                    }else {
                        Schedule::create([
                            'hari'          => $hari,
                            'jam_start'     => $start,
                            'jam_end'       => $end,
                            'matapelajaran' => $request->matapelajaran[$i],
                            'guru'          => $request->guru[$i],
                            'tahun'         => $request->tahun,
                            'jurusan'       => $request->jurusan,
                            'kelas'         => $kelas,
                        ]);
                        $j++;
                    }
                }
            } else {

                for ($k = 0; $k < 3; $k) {
                    $schedule = Schedule::orderBy('jam_end', 'DESC')->where('hari', $hari)->where('kelas', $kelas)->where('jurusan', $request->jurusan)->first();

                    if ($schedule == null) {
                        $start  = date('H:i:s', strtotime('07:00'));
                    } else {
                        $start  = date('H:i:s', strtotime($schedule->jam_end));
                    }

                    $end = date('H:i:s', strtotime('+45 minutes', strtotime($start)));

                    if ($start > date('H:i:s', strtotime('10:30')) && $start < date('H:i:s', strtotime('11:00'))) {
                        $ist1 = Subject::where('matapelajaran', 'Istirahat 1')->first();
                        Schedule::create([
                            'hari'          => $hari,
                            'jam_start'     => date('H:i:s', strtotime($start)),
                            'jam_end'       => date('H:i:s', strtotime('+30 minutes', strtotime($start))),
                            'matapelajaran' => $ist1->id,
                            'guru'          => 0,
                            'tahun'         => $request->tahun,
                            'jurusan'       => $request->jurusan,
                            'kelas'         => $kelas,
                        ]);
                    } elseif ($start > date('H:i:s', strtotime('12:00')) && $start < date('H:i:s', strtotime('13:00'))) {
                        $ist2 = Subject::where('matapelajaran', 'Istirahat 2')->first();
                        Schedule::create([
                            'hari'          => $hari,
                            'jam_start'     => date('H:i:s', strtotime($start)),
                            'jam_end'       => date('H:i:s', strtotime('+1 hours', strtotime($start))),
                            'matapelajaran' => $ist2->id,
                            'guru'          => 0,
                            'tahun'         => $request->tahun,
                            'jurusan'       => $request->jurusan,
                            'kelas'         => $kelas,
                        ]);
                    }else {
                        Schedule::create([
                            'hari'          => $hari,
                            'jam_start'     => $start,
                            'jam_end'       => $end,
                            'matapelajaran' => $request->matapelajaran[$i],
                            'guru'          => $request->guru[$i],
                            'tahun'         => $request->tahun,
                            'jurusan'       => $request->jurusan,
                            'kelas'         => $kelas,
                        ]);
                        $k++;
                    }
                }
            }
        }

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
        } elseif ($request->hari == 2) {
            $hari = 'selasa';
        } elseif ($request->hari == 3) {
            $hari = 'rabu';
        } elseif ($request->hari == 4) {
            $hari = 'kamis';
        } elseif ($request->hari == 5) {
            $hari = 'jum`at';
        } else {
            $hari = 'sabtu';
        }

        if ($request->kelas == 1) {
            $kelas = 'X';
        } elseif ($request->kelas == 2) {
            $kelas = 'XI';
        } else {
            $kelas = 'XII';
        }

        $schedule = Schedule::orderBy('created_at', 'DESC')->where('hari', $hari)->where('kelas', $kelas)->where('jurusan', $request->jurusan)->first();

        if ($schedule == null) {
            $start  = date('H:i:s', strtotime('07:00'));
        } else {
            $start  = date('H:i:s', strtotime($schedule->jam_end));
        }

        if ($request->jam == 1) {
            $jam_start = $start;
            $jam_end = date('H:i:s', strtotime('+45 minutes', strtotime($start)));
        } elseif ($request->jam == 2) {
            $jam_start = $start;
            $jam_end = date('H:i:s', strtotime('+1 hours 30 minutes', strtotime($start)));
        } else {
            $jam_start = $start;
            $jam_end = date('H:i:s', strtotime('+2 hours 15 minutes', strtotime($start)));
        }

        Schedule::where('id', $schedule->id)
            ->update([
                'hari'          => $hari,
                'jam_start'     => $jam_start,
                'jam_end'       => $jam_end,
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
