<?php

namespace App\Exports;

use App\Models\Teacher;
use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class TeacherExport implements FromView
{
    public function view(): View
    {
        return view('export.teacher', ['teacher' => Teacher::where('kelas', $this->kelas)->where('no_kelas', $this->no_kelas)->get()]);
    }
}
