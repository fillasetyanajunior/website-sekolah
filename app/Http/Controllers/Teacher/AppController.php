<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppController extends Controller
{
    function __construct()
    {
        $this->middleware('auth:teacher');

        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('teacher')->user();
            return $next($request);
        });
    }
}
