<?php

namespace App\Http\Controllers\Counselingguidance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends AppController
{
    public function index()
    {
        $title = 'Dashboard';
        return view('counselingguidance.dashboard', compact('title'));
    }
}
