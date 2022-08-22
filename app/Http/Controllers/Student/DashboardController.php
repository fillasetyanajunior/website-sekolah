<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends AppController
{
    public function index()
    {
        $title = 'Dashboard';
        return view('student.dashboard', compact('title'));
    }
}
