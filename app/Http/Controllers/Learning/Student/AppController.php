<?php

namespace App\Http\Controllers\Learning\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppController extends Controller
{
    function __construct()
    {
        $this->middleware('auth:student_learning');

        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('student_learning')->user();
            return $next($request);
        });
    }
}
