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
use Illuminate\Support\Facades\Crypt;
use Maatwebsite\Excel\Facades\Excel;

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

        $years      = explode('/', $request->tahun);
        $jurusan    = Department::where('jurusan', $request->jurusan)->first();
        $tahun      = Year::where('tahun', $years[0])->where('semester', $years[1])->first();

        for ($i = 0; $i < count($request->matapelajaran); $i++){

            $matapelajaran  = Subject::where('matapelajaran', $request->matapelajaran[$i])->first();
            $guru           = Teacher::where('name', $request->guru[$i])->first();
            if ($request->jam[$i] == 1) {

                if ($request->kelas == 1) {
                    $schedule = Schedule::orderBy('jam_end', 'DESC')->where('hari', $hari)->where('kelas', $kelas)->where('no_kelas', $request->no_kelas)->first();
                } else {
                    $schedule = Schedule::orderBy('jam_end', 'DESC')->where('hari', $hari)->where('kelas', $kelas)->where('jurusan', $jurusan->id)->first();
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
                        $this->addkelas($hari, date('H:i:s', strtotime($start)), date('H:i:s', strtotime('+30 minutes', strtotime($start))), $ist1->id, 0, $tahun->id, $request->no_kelas, $kelas);
                    } else {
                        $this->addjurusan($hari, date('H:i:s', strtotime($start)), date('H:i:s', strtotime('+30 minutes', strtotime($start))), $ist1->id, 0, $tahun->id, $jurusan->id, $kelas);
                    }
                } elseif ($start > date('H:i:s', strtotime('12:00')) && $start < date('H:i:s', strtotime('13:00'))) {
                    $ist2 = Subject::where('matapelajaran', 'Istirahat 2')->first();
                    if ($request->kelas == 1) {
                        $this->addkelas($hari, date('H:i:s', strtotime($start)), date('H:i:s', strtotime('+1 hours', strtotime($start))), $ist2->id, 0, $tahun->id, $request->no_kelas, $kelas);
                    } else {
                        $this->addjurusan($hari, date('H:i:s', strtotime($start)), date('H:i:s', strtotime('+1 hours', strtotime($start))), $ist2->id, 0, $tahun->id, $jurusan->id, $kelas);
                    }
                } else {
                    if ($request->kelas == 1) {
                        $this->addkelas($hari, $start, $end, $matapelajaran->id, $guru->id_guru, $tahun->id, $request->no_kelas, $kelas);
                    } else {
                        $this->addjurusan($hari, $start, $end, $matapelajaran->id, $guru->id_guru, $tahun->id, $jurusan->id, $kelas);
                    }
                }

            } else if ($request->jam[$i] == 2) {

                for ($j = 0; $j < 2; $j) {
                    if ($request->kelas == 1) {
                        $schedule = Schedule::orderBy('jam_end', 'DESC')->where('hari', $hari)->where('kelas', $kelas)->where('no_kelas', $request->no_kelas)->first();
                    } else {
                        $schedule = Schedule::orderBy('jam_end', 'DESC')->where('hari', $hari)->where('kelas', $kelas)->where('jurusan', $jurusan->id)->first();
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
                            $this->addkelas($hari, date('H:i:s', strtotime($start)), date('H:i:s', strtotime('+30 minutes', strtotime($start))), $ist1->id, 0, $tahun->id, $request->no_kelas, $kelas);
                        }else{
                            $this->addjurusan($hari, date('H:i:s', strtotime($start)), date('H:i:s', strtotime('+30 minutes', strtotime($start))), $ist1->id, 0, $tahun->id, $jurusan->id, $kelas);
                        }
                    } elseif ($start > date('H:i:s', strtotime('12:00')) && $start < date('H:i:s', strtotime('13:00'))) {
                        $ist2 = Subject::where('matapelajaran', 'Istirahat 2')->first();
                        if ($request->kelas == 1) {
                            $this->addkelas($hari, date('H:i:s', strtotime($start)), date('H:i:s', strtotime('+1 hours', strtotime($start))), $ist2->id, 0, $tahun->id, $request->no_kelas, $kelas);
                        }else {
                            $this->addjurusan($hari, date('H:i:s', strtotime($start)), date('H:i:s', strtotime('+1 hours', strtotime($start))), $ist2->id, 0, $tahun->id, $jurusan->id, $kelas);
                        }
                    }else {
                        if ($request->kelas == 1) {
                            $this->addkelas($hari, $start, $end, $matapelajaran->id, $guru->id_guru, $tahun->id, $request->no_kelas, $kelas);
                        }else {
                            $this->addjurusan($hari, $start, $end, $matapelajaran->id, $guru->id_guru, $tahun->id, $jurusan->id, $kelas);
                        }
                        $j++;
                    }
                }
            } else {

                for ($k = 0; $k < 3; $k) {
                    if ($request->kelas == 1) {
                        $schedule = Schedule::orderBy('jam_end', 'DESC')->where('hari', $hari)->where('kelas', $kelas)->where('no_kelas', $request->no_kelas)->first();
                    } else {
                        $schedule = Schedule::orderBy('jam_end', 'DESC')->where('hari', $hari)->where('kelas', $kelas)->where('jurusan', $jurusan->id)->first();
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
                            $this->addkelas($hari, date('H:i:s', strtotime($start)), date('H:i:s', strtotime('+30 minutes', strtotime($start))), $ist1->id, 0, $tahun->id, $request->no_kelas, $kelas);
                        } else {
                            $this->addjurusan($hari, date('H:i:s', strtotime($start)), date('H:i:s', strtotime('+30 minutes', strtotime($start))), $ist1->id, 0, $tahun->id, $jurusan->id, $kelas);
                        }
                    } elseif ($start > date('H:i:s', strtotime('12:00')) && $start < date('H:i:s', strtotime('13:00'))) {
                        $ist2 = Subject::where('matapelajaran', 'Istirahat 2')->first();
                        if ($request->kelas == 1) {
                            $this->addkelas($hari, date('H:i:s', strtotime($start)), date('H:i:s', strtotime('+1 hours', strtotime($start))), $ist2->id, 0, $tahun->id, $request->no_kelas, $kelas);
                        } else {
                            $this->addjurusan($hari, date('H:i:s', strtotime($start)), date('H:i:s', strtotime('+1 hours', strtotime($start))), $ist2->id, 0, $tahun->id, $jurusan->id, $kelas);
                        }
                    } else {
                        if ($request->kelas == 1) {
                            $this->addkelas($hari, $start, $end, $matapelajaran->id, $guru->id_guru, $tahun->id, $request->no_kelas, $kelas);
                        } else {
                            $this->addjurusan($hari, $start, $end, $matapelajaran->id, $guru->id_guru, $tahun->id, $jurusan->id, $kelas);
                        }
                        $k++;
                    }
                }
            }
        }

        return redirect()->back()->with('success', 'Data Berhasil Ditambahkan');
    }

    public function edit(Request $request)
    {
        $schedule = Schedule::find(Crypt::decrypt($request->schedule));

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

        $jam = Schedule::where('matapelajaran', $schedule->matapelajaran)->where('hari', $schedule->hari)->where('kelas', $schedule->kelas)->count();

        if ($schedule->kelas == 'X') {
            $kelas = 1;
        } elseif ($schedule->kelas == 'XII') {
            $kelas = 2;
        } else {
            $kelas = 3;
        }

        return response()->json([
            'hari'          => $hari,
            'jam'           => $jam,
            'kelas'         => $kelas,
            'matapelajaran' => Subject::find($schedule->matapelajaran)->matapelajaran,
            'guru'          => Teacher::find($schedule->guru)->name,
            'tahun'         => Year::find($schedule->tahun)->tahun . '/' . Year::find($schedule->tahun)->semester,
            'jurusan'       => Department::find($schedule->jurusan)->jurusan,
            'no_kelas'      => $schedule->no_kelas,

        ]);
    }

    public function update(Request $request)
    {
        $schedule = Schedule::find(Crypt::decrypt($request->schedule));

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

        $years          = explode('/', $request->tahun);
        $jurusan        = Department::where('jurusan', $request->jurusan)->first();
        $tahun          = Year::where('tahun', $years[0])->where('semester', $years[1])->first();
        $matapelajaran  = Subject::where('matapelajaran', $request->matapelajaran_edit)->first();
        $guru           = Teacher::where('name', $request->guru_edit)->first();

        if ($request->jam_edit == 1) {
            if ($request->kelas == 1) {
                $schedules = Schedule::orderBy('jam_start')->where('hari', $hari)->where('no_kelas', $schedule->no_kelas)->where('matapelajaran', $schedule->matapelajaran)->get();
            }else{
                $schedules = Schedule::orderBy('jam_start')->where('hari', $hari)->where('jurusan', $schedule->jurusan)->where('matapelajaran', $schedule->matapelajaran)->get();
            }

            $jam_start  = $schedules[0]->jam_start;
            $jam_end    = date('H:i:s', strtotime('+45 minutes', strtotime($jam_start)));
            foreach ($schedules as $showschedules) {
                if ($request->kelas == 1) {
                    $this->updatekelas($showschedules->id, $hari, $jam_start, $jam_end, $matapelajaran->id, $guru->id_guru, $tahun->id, $request->no_kelas, $kelas);
                } else {
                    $this->updatejurusan($showschedules->id, $hari, $jam_start, $jam_end, $matapelajaran->id, $guru->id_guru, $tahun->id, $jurusan->id, $kelas);
                }
            }

            if (count($schedules) > 1) {
                Schedule::destroy($schedules[1]->id);
            }

        }elseif ($request->jam_edit == 2) {
            if ($request->kelas == 1) {
                $schedules = Schedule::orderBy('jam_start')->where('hari', $hari)->where('no_kelas', $schedule->no_kelas)->where('matapelajaran', $schedule->matapelajaran)->get();
            } else {
                $schedules = Schedule::orderBy('jam_start')->where('hari', $hari)->where('jurusan', $schedule->jurusan)->where('matapelajaran', $schedule->matapelajaran)->get();
            }

            foreach ($schedules as $showschedules) {
                $jam_start  = $showschedules->jam_start;
                $jam_end    = date('H:i:s', strtotime('+45 minutes', strtotime($jam_start)));
                if ($request->kelas == 1) {
                    $this->updatekelas($showschedules->id, $hari, $jam_start, $jam_end, $matapelajaran->id, $guru->id_guru, $tahun->id, $request->no_kelas, $kelas);
                } else {
                    $this->updatejurusan($showschedules->id, $hari, $jam_start, $jam_end, $matapelajaran->id, $guru->id_guru, $tahun->id, $jurusan->id, $kelas);
                }
            }

            if (count($schedules) == 1) {
                if ($request->kelas == 1) {
                    $this->addkelas($hari, $jam_end, date('H:i:s',(strtotime('+45 minutes',strtotime($jam_end)))), $matapelajaran->id, $guru->id_guru, $tahun->id, $request->no_kelas, $kelas);
                } else {
                    $this->addjurusan($hari, $jam_end, date('H:i:s', (strtotime('+45 minutes', strtotime($jam_end)))), $matapelajaran->id, $guru->id_guru, $tahun->id, $jurusan->id, $kelas);
                }
            }

            if (count($schedules) > 2) {
                Schedule::destroy($schedules[2]->id);
            }
        }else {
            if ($request->kelas == 1) {
                $schedules = Schedule::orderBy('jam_start')->where('hari', $hari)->where('no_kelas', $schedule->no_kelas)->where('matapelajaran', $schedule->matapelajaran)->get();
            } else {
                $schedules = Schedule::orderBy('jam_start')->where('hari', $hari)->where('jurusan', $schedule->jurusan)->where('matapelajaran', $schedule->matapelajaran)->get();
            }

            foreach ($schedules as $showschedules) {
                $jam_start  = $showschedules->jam_start;
                $jam_end    = date('H:i:s', strtotime('+45 minutes', strtotime($jam_start)));
                if ($request->kelas == 1) {
                    $this->updatekelas($showschedules->id, $hari, $jam_start, $jam_end, $matapelajaran->id, $guru->id_guru, $tahun->id, $request->no_kelas, $kelas);
                } else {
                    $this->updatejurusan($showschedules->id, $hari, $jam_start, $jam_end, $matapelajaran->id, $guru->id_guru, $tahun->id, $jurusan->id, $kelas);
                }
            }

            if (count($schedules) == 2) {
                if ($request->kelas == 1) {
                    $this->addkelas($hari, $jam_end, date('H:i:s',(strtotime('+45 minutes',strtotime($jam_end)))), $matapelajaran->id, $guru->id_guru, $tahun->id, $request->no_kelas, $kelas);
                } else {
                    $this->addjurusan($hari, $jam_end, date('H:i:s', (strtotime('+45 minutes', strtotime($jam_end)))), $matapelajaran->id, $guru->id_guru, $tahun->id, $jurusan->id, $kelas);
                }
            }
        }

        return redirect()->back()->with('success', 'Data Berhasil Update');
    }

    public function destroy(Request $request)
    {
        Schedule::destroy(Crypt::decrypt($request->schedule));
        return redirect()->back()->with('success', 'Data Berhasil Delete');
    }

    public function addjurusan($hari, $jam_start, $jam_end, $matapelajaran, $guru, $tahun, $jurusan, $kelas)
    {
        Schedule::create([
            'hari'          => $hari,
            'jam_start'     => $jam_start,
            'jam_end'       => $jam_end,
            'matapelajaran' => $matapelajaran,
            'guru'          => $guru,
            'tahun'         => $tahun,
            'jurusan'       => $jurusan,
            'kelas'         => $kelas,
        ]);
    }

    public function addkelas($hari, $jam_start, $jam_end, $matapelajaran, $guru, $tahun, $no_kelas, $kelas)
    {
        Schedule::create([
            'hari'          => $hari,
            'jam_start'     => $jam_start,
            'jam_end'       => $jam_end,
            'matapelajaran' => $matapelajaran,
            'guru'          => $guru,
            'tahun'         => $tahun,
            'no_kelas'      => $no_kelas,
            'kelas'         => $kelas,
        ]);
    }
    public function updatejurusan($id, $hari, $jam_start, $jam_end, $matapelajaran, $guru, $tahun, $jurusan, $kelas)
    {
        Schedule::where('id', $id)
            ->update([
            'hari'          => $hari,
            'jam_start'     => $jam_start,
            'jam_end'       => $jam_end,
            'matapelajaran' => $matapelajaran,
            'guru'          => $guru,
            'tahun'         => $tahun,
            'jurusan'       => $jurusan,
            'kelas'         => $kelas,
        ]);
    }

    public function updatekelas($id, $hari, $jam_start, $jam_end, $matapelajaran, $guru, $tahun, $no_kelas, $kelas)
    {
        Schedule::where('id', $id)
            ->update([
            'hari'          => $hari,
            'jam_start'     => $jam_start,
            'jam_end'       => $jam_end,
            'matapelajaran' => $matapelajaran,
            'guru'          => $guru,
            'tahun'         => $tahun,
            'no_kelas'      => $no_kelas,
            'kelas'         => $kelas,
        ]);
    }
}
