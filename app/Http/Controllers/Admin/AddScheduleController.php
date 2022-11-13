<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\ScheduleImport;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AddScheduleController extends AppController
{
    public function index()
    {
        $title      = 'Input Jadwal Pelajaran';
        $schedule   = Schedule::paginate(20);
        return view('admin.inputdata.schedule', compact('title', 'schedule'));
    }

    public function store(Request $request)
    {
        Excel::import(new ScheduleImport, $request->import_excel);
        return redirect(route('admin.input-schedule'))->with('success', 'Data Berhasil Ditambahkan');
    }
}
