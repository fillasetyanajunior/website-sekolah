<?php

namespace App\Http\Controllers\Learning\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppController extends Controller
{
    function __construct()
    {
        $this->middleware('auth:teacher_learning');

        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('teacher_learning')->user();
            return $next($request);
        });
    }
}
