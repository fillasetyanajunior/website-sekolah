<?php

namespace App\Http\Controllers\Api\Auth\Student;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginApiController extends Controller
{
    public function login(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status_code' => 400,
                'name' => '',
                'access_token' => '',
                'token_type' => '',
            ]);
        } else {
            $user = Student::where('username', $request->username)->first();

            if ($user == null) {
                return response()->json([
                    'status_code' => 400,
                    'name' => '',
                    'access_token' => '',
                    'token_type' => '']);
            }

            if (!Hash::check($request->password, $user->password, [])) {
                return response()->json([
                    'status_code' => 400,
                    'name' => '',
                    'access_token' => '',
                    'token_type' => '',
                ]);
            }

            $tokenResult = $user->createToken('student');
            return response()->json([
                'status_code' => 200,
                'name' => $tokenResult->accessToken->name,
                'access_token' => $tokenResult->plainTextToken,
                'token_type' => 'Bearer',
            ]);
        }
    }
}
