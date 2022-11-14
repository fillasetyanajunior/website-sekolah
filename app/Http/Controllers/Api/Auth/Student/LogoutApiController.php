<?php

namespace App\Http\Controllers\Api\Auth\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutApiController extends Controller
{
    public function logout()
    {
        $user = request()->user();
        $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();
        return response()->json(['status_code' => 200]);
    }
}
