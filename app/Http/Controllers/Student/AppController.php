<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppController extends Controller
{
    function __construct()
    {
        $this->middleware('auth:student');

        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('student')->user();
            return $next($request);
        });
    }
}
