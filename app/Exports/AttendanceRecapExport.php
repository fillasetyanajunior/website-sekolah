<?php

namespace App\Exports;

use App\Models\Attendance;
use App\Models\Department;
use App\Models\Subject;
use App\Models\TeacherDetail;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AttendanceRecapExport implements FromView
{
    public $matapelajaran, $kelas, $guru, $jurusan, $no_kelas;
    public function __construct($matapelajaran, $kelas, $guru, $jurusan, $no_kelas)
    {
        $this->matapelajaran    = Subject::where('matapelajaran', $matapelajaran)->first()->id;
        $this->kelas            = $kelas;
        $this->guru             = $guru;
        $this->jurusan          = Department::where('jurusan', $jurusan)->first()->id;
        $this->no_kelas         = $no_kelas;
    }

    public function view(): View
    {
        if ($this->kelas == 'X') {
            return view('export.attendancerecap',['attendance' => Attendance::where('matapelajaran', $this->matapelajaran)->where('kelas', $this->kelas)->where('guru', $this->guru)->where('no_kelas', $this->no_kelas)->get()]);
        } else {
            return view('export.attendancerecap',['attendance' => Attendance::where('matapelajaran', $this->matapelajaran)->where('kelas', $this->kelas)->where('guru', $this->guru)->where('jurusan', $this->jurusan)->get()]);
        }

    }
}
