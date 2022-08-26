<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends AppController
{
    public function index()
    {
        $title      = 'Dashboard';
        $schedule   = Schedule::where('guru', Auth::user()->id_guru)->get();
        return view('teacher.dashboard', compact('title', 'schedule'));
    }
}
