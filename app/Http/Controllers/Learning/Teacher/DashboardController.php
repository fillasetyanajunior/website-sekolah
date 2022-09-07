<?php

namespace App\Http\Controllers\Learning\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends AppController
{
    public function index()
    {
        $title = 'Dashboard';
        $class = Classroom::where('id_guru',Auth::user()->id_guru)->get();
        return view('teacher.learning.dashboard',compact('title','class'));
    }
}
