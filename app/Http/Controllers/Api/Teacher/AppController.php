<?php

namespace App\Http\Controllers\Api\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AppController extends Controller
{
    public function __construct()
    {
        if (request()->user()->currentAccessToken()->name != 'teacher') {
            return response()->json(['status' => 'error']);
        }
    }
}
