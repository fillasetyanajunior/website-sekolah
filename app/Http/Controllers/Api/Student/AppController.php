<?php

namespace App\Http\Controllers\Api\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AppController extends Controller
{
    public function __construct()
    {
        if (request()->user()->currentAccessToken()->name != 'student') {
            return response()->json(['status' => 'error']);
        }
    }
}
