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
            $respon = [
                'status'    => 'error',
                'msg'       => 'Validator error',
                'errors'    => $validate->errors(),
                'content'   => null,
            ];
            return response()->json($respon, 200);
        } else {
            $user = Student::where('username', $request->username)->first();

            if ($user == null) {
                return response()->json(['status' => 'error']);
            }

            if (!Hash::check($request->password, $user->password, [])) {
                return response()->json(['status' => 'error', 'msg' => 'Error in Login',]);
            }

            $tokenResult = $user->createToken('student');
            $respon = [
                'status'    => 'success',
                'msg'       => 'Login successfully',
                'errors'    => null,
                'content'   => [
                        'status_code' => 200,
                        'name' => $tokenResult->accessToken->name,
                        'access_token' => $tokenResult->plainTextToken,
                        'token_type' => 'Bearer',
                ]
            ];
            return response()->json($respon, 200);
        }
    }
}
