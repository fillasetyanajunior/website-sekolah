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
        return view('export.teacher', ['teacher' => Teacher::all()]);
    }
}
