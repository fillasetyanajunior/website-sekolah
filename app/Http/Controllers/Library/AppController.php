<?php

namespace App\Http\Controllers\Library;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppController extends Controller
{
    function __construct()
    {
        $this->middleware('auth:library');

        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('library')->user();
            return $next($request);
        });
    }
}
