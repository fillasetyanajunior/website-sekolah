<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends AppController
{
    public function index()
    {
        $title = 'Dashboard';
        return view('teacher.dashboard', compact('title'));
    }
}
