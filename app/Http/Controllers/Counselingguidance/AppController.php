<?php

namespace App\Http\Controllers\Counselingguidance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppController extends Controller
{
    function __construct()
    {
        $this->middleware('auth:counseling');

        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('counseling')->user();
            return $next($request);
        });
    }
}
