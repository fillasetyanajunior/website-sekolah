<?php

namespace App\Exports;

use App\Models\Department;
use App\Models\StudentDetail;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class StudentExport implements FromView
{
    public $kelas, $jurusan, $no_kelas;
    public function __construct($kelas, $jurusan, $no_kelas)
    {
        $this->kelas    = $kelas;
        $this->jurusan  = $jurusan;
        $this->no_kelas = $no_kelas;
    }

    public function view(): View
    {
        if ($this->kelas == 'X') {
            return view('export.student', ['student' => StudentDetail::where('kelas', $this->kelas)->where('no_kelas', $this->no_kelas)->get()]);
        } else {
            $jurusan = Department::where('jurusan', $this->jurusan)->first()->id;
            return view('export.student', ['student' => StudentDetail::where('kelas', $this->kelas)->where('jurusan', $jurusan)->get('id')]);
        }

    }
}
