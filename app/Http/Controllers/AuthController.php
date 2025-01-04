<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //

    public function login (Request $request) {

        $validator =  Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => 401,
                "message" => $validator->errors(),
            ], 403);
        }

        $credential = $validator->validated();

        if (!$token = Auth('api')->attempt($credential)) {
            return response()->json([
                'status' => 403,
                'error' => 'Unauthorized'
            ], 403);
        }

        $user = Auth('api')->user();

        return response()->json([
            'success' => true,
            'user'=> $user,
            'token' => $token,
        ]);
    
    }

    public function logout () {

        Auth('api')->logout(true);

        return response()->json(['message' => 'Successfully logged out']);

    }

    public function me() {
        $user = Auth('api')->user();

        return response()->json([
            "status" => 200,
            "user" => $user
        ],200);
    }
}
