<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Schedule;
use App\Models\StudentDetail;
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
        $class      = StudentDetail::groupBy('no_kelas')->get('no_kelas');
        return view('admin.schedule.schedule', compact('schedule', 'subject', 'teacher', 'year', 'department', 'title', 'class'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'hari'          => 'required',
            'jam'           => 'required',
            'matapelajaran' => 'required',
            'guru'          => 'required',
            'tahun'         => 'required',
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

                if ($request->kelas == 1) {
                    $schedule = Schedule::orderBy('jam_end', 'DESC')->where('hari', $hari)->where('kelas', $kelas)->where('no_kelas', $request->no_kelas)->first();
                } else {
                    $schedule = Schedule::orderBy('jam_end', 'DESC')->where('hari', $hari)->where('kelas', $kelas)->where('jurusan', $request->jurusan)->first();
                }


                if ($schedule == null) {
                    $start  = date('H:i:s', strtotime('07:00'));
                } else {
                    $start  = date('H:i:s', strtotime($schedule->jam_end));
                }

                $end = date('H:i:s', strtotime('+45 minutes', strtotime($start)));

                if ($start > date('H:i:s', strtotime('10:30')) && $start < date('H:i:s', strtotime('11:00'))) {
                    $ist1 = Subject::where('matapelajaran', 'Istirahat 1')->first();
                    if ($request->kelas == 1) {
                        $this->addkelas($hari, date('H:i:s', strtotime($start)), date('H:i:s', strtotime('+30 minutes', strtotime($start))), $ist1->id, 0, $request->tahun, $request->no_kelas, $kelas);
                    } else {
                        $this->addjurusan($hari, date('H:i:s', strtotime($start)), date('H:i:s', strtotime('+30 minutes', strtotime($start))), $ist1->id, 0, $request->tahun, $request->jurusan, $kelas);
                    }
                } elseif ($start > date('H:i:s', strtotime('12:00')) && $start < date('H:i:s', strtotime('13:00'))) {
                    $ist2 = Subject::where('matapelajaran', 'Istirahat 2')->first();
                    if ($request->kelas == 1) {
                        $this->addkelas($hari, date('H:i:s', strtotime($start)), date('H:i:s', strtotime('+1 hours', strtotime($start))), $ist2->id, 0, $request->tahun, $request->no_kelas, $kelas);
                    } else {
                        $this->addjurusan($hari, date('H:i:s', strtotime($start)), date('H:i:s', strtotime('+1 hours', strtotime($start))), $ist2->id, 0, $request->tahun, $request->jurusan, $kelas);
                    }
                } else {
                    if ($request->kelas == 1) {
                        $this->addkelas($hari, $start, $end, $request->matapelajaran[$i], $request->guru[$i], $request->tahun, $request->no_kelas, $kelas);
                    } else {
                        $this->addjurusan($hari, $start, $end, $request->matapelajaran[$i], $request->guru[$i], $request->tahun, $request->jurusan, $kelas);
                    }
                }

            } else if ($request->jam[$i] == 2) {

                for ($j = 0; $j < 2; $j) {
                    if ($request->kelas == 1) {
                        $schedule = Schedule::orderBy('jam_end', 'DESC')->where('hari', $hari)->where('kelas', $kelas)->where('no_kelas', $request->no_kelas)->first();
                    } else {
                        $schedule = Schedule::orderBy('jam_end', 'DESC')->where('hari', $hari)->where('kelas', $kelas)->where('jurusan', $request->jurusan)->first();
                    }

                    if ($schedule == null) {
                        $start  = date('H:i:s', strtotime('07:00'));
                    } else {
                        $start  = date('H:i:s', strtotime($schedule->jam_end));
                    }

                    $end = date('H:i:s', strtotime('+45 minutes', strtotime($start)));

                    if ($start > date('H:i:s', strtotime('10:30')) && $start < date('H:i:s', strtotime('11:00'))) {
                        $ist1 = Subject::where('matapelajaran', 'Istirahat 1')->first();
                        if ($request->kelas == 1) {
                            $this->addkelas($hari, date('H:i:s', strtotime($start)), date('H:i:s', strtotime('+30 minutes', strtotime($start))), $ist1->id, 0, $request->tahun, $request->no_kelas, $kelas);
                        }else{
                            $this->addjurusan($hari, date('H:i:s', strtotime($start)), date('H:i:s', strtotime('+30 minutes', strtotime($start))), $ist1->id, 0, $request->tahun, $request->jurusan, $kelas);
                        }
                    } elseif ($start > date('H:i:s', strtotime('12:00')) && $start < date('H:i:s', strtotime('13:00'))) {
                        $ist2 = Subject::where('matapelajaran', 'Istirahat 2')->first();
                        if ($request->kelas == 1) {
                            $this->addkelas($hari, date('H:i:s', strtotime($start)), date('H:i:s', strtotime('+1 hours', strtotime($start))), $ist2->id, 0, $request->tahun, $request->no_kelas, $kelas);
                        }else {
                            $this->addjurusan($hari, date('H:i:s', strtotime($start)), date('H:i:s', strtotime('+1 hours', strtotime($start))), $ist2->id, 0, $request->tahun, $request->jurusan, $kelas);
                        }
                    }else {
                        if ($request->kelas == 1) {
                            $this->addkelas($hari, $start, $end, $request->matapelajaran[$i], $request->guru[$i], $request->tahun, $request->no_kelas, $kelas);
                        }else {
                            $this->addjurusan($hari, $start, $end, $request->matapelajaran[$i], $request->guru[$i], $request->tahun, $request->jurusan, $kelas);
                        }
                        $j++;
                    }
                }
            } else {

                for ($k = 0; $k < 3; $k) {
                    if ($request->kelas == 1) {
                        $schedule = Schedule::orderBy('jam_end', 'DESC')->where('hari', $hari)->where('kelas', $kelas)->where('no_kelas', $request->no_kelas)->first();
                    } else {
                        $schedule = Schedule::orderBy('jam_end', 'DESC')->where('hari', $hari)->where('kelas', $kelas)->where('jurusan', $request->jurusan)->first();
                    }

                    if ($schedule == null) {
                        $start  = date('H:i:s', strtotime('07:00'));
                    } else {
                        $start  = date('H:i:s', strtotime($schedule->jam_end));
                    }

                    $end = date('H:i:s', strtotime('+45 minutes', strtotime($start)));

                    if ($start > date('H:i:s', strtotime('10:30')) && $start < date('H:i:s', strtotime('11:00'))) {
                        $ist1 = Subject::where('matapelajaran', 'Istirahat 1')->first();
                        if ($request->kelas == 1) {
                            $this->addkelas($hari, date('H:i:s', strtotime($start)), date('H:i:s', strtotime('+30 minutes', strtotime($start))), $ist1->id, 0, $request->tahun, $request->no_kelas, $kelas);
                        } else {
                            $this->addjurusan($hari, date('H:i:s', strtotime($start)), date('H:i:s', strtotime('+30 minutes', strtotime($start))), $ist1->id, 0, $request->tahun, $request->jurusan, $kelas);
                        }
                    } elseif ($start > date('H:i:s', strtotime('12:00')) && $start < date('H:i:s', strtotime('13:00'))) {
                        $ist2 = Subject::where('matapelajaran', 'Istirahat 2')->first();
                        if ($request->kelas == 1) {
                            $this->addkelas($hari, date('H:i:s', strtotime($start)), date('H:i:s', strtotime('+1 hours', strtotime($start))), $ist2->id, 0, $request->tahun, $request->no_kelas, $kelas);
                        } else {
                            $this->addjurusan($hari, date('H:i:s', strtotime($start)), date('H:i:s', strtotime('+1 hours', strtotime($start))), $ist2->id, 0, $request->tahun, $request->jurusan, $kelas);
                        }
                    } else {
                        if ($request->kelas == 1) {
                            $this->addkelas($hari, $start, $end, $request->matapelajaran[$i], $request->guru[$i], $request->tahun, $request->no_kelas, $kelas);
                        } else {
                            $this->addjurusan($hari, $start, $end, $request->matapelajaran[$i], $request->guru[$i], $request->tahun, $request->jurusan, $kelas);
                        }
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

        if ($request->kelas == 1) {
            $schedule = Schedule::orderBy('jam_end', 'DESC')->where('hari', $hari)->where('kelas', $kelas)->where('no_kelas', $request->no_kelas)->first();
        } else {
            $schedule = Schedule::orderBy('jam_end', 'DESC')->where('hari', $hari)->where('kelas', $kelas)->where('jurusan', $request->jurusan)->first();
        }

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

        if ($request->kelas == 1) {
            $this->addkelas($hari, $jam_start, $jam_end, $request->matapelajaran, $request->guru, $request->tahun, $request->no_kelas, $kelas);
        } else {
            $this->addjurusan($hari, $jam_start, $jam_end, $request->matapelajaran, $request->guru, $request->tahun, $request->jurusan, $kelas);
        }

        return redirect()->back()->with('success', 'Data Berhasil Update');
    }

    public function destroy(Schedule $schedule)
    {
        Schedule::destroy($schedule->id);
        return redirect()->back()->with('success', 'Data Berhasil Delete');
    }

    public function addjurusan($hari, $jam_start, $jam_end, $istirahat, $guru, $tahun, $jurusan, $kelas)
    {
        Schedule::create([
            'hari'          => $hari,
            'jam_start'     => $jam_start,
            'jam_end'       => $jam_end,
            'matapelajaran' => $istirahat,
            'guru'          => $guru,
            'tahun'         => $tahun,
            'jurusan'       => $jurusan,
            'kelas'         => $kelas,
        ]);
    }

    public function addkelas($hari, $jam_start, $jam_end, $istirahat, $guru, $tahun, $no_kelas, $kelas)
    {
        Schedule::create([
            'hari'          => $hari,
            'jam_start'     => $jam_start,
            'jam_end'       => $jam_end,
            'matapelajaran' => $istirahat,
            'guru'          => $guru,
            'tahun'         => $tahun,
            'no_kelas'      => $no_kelas,
            'kelas'         => $kelas,
        ]);
    }
}
