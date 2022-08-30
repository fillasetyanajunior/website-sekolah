<?php

namespace App\Http\Controllers\Api\Auth\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
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
                'status_code'   => 500,
                'name'          => '',
                'access_token'  => '',
                'token_type'    => '',
            ];

            return response()->json($respon);
        } else {
            $user = Teacher::where('username', $request->username)->first();

            if ($user == null) {
                return response()->json(['status' => 'error']);
            }

            if (!Hash::check($request->password, $user->password, [])) {
                return response()->json(['status' => 'error', 'msg' => 'Error in Login',]);
            }

            $tokenResult = $user->createToken('teacher');
            $respon = [
                'status_code'   => 200,
                'name'          => $tokenResult->accessToken->name,
                'access_token'  => $tokenResult->plainTextToken,
                'token_type'    => 'Bearer',
            ];

            return response()->json($respon);
        }
    }
}
