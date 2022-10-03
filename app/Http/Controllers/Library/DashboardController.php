<?php

namespace App\Http\Controllers\Library;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends AppController
{
    public function index()
    {
        $title = "Dashboard";
        return view('library.dashboard', compact('title'));
    }
}
