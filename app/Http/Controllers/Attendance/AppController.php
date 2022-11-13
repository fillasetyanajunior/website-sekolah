<?php

namespace App\Http\Controllers\Attendance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppController extends Controller
{
    function __construct()
    {
        $this->middleware('auth:app');

        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('app')->user();
            return $next($request);
        });
    }
}
