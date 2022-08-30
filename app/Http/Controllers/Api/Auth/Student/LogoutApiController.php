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
        $respon = [
            'status_code' => 200,
        ];
        return response()->json($respon, 200);
    }
}
