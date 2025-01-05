<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request) {

        try{
            $validator = Validator::make($request->all(), [
                'email' => 'required|email', // Email wajib, valid, unik di tabel users
                'password' => 'required|string', // Password wajib, minimal 8 karakter, dan dikonfirmasi
            ]);

            if(!$token = Auth('api')->attempt($validator->validated())) {
                return response()->json(["message" => "User Failed to Login"], 400);
            }

            $user = Auth('api')->user();

            return response()->json([
                "status" => 200,
                "message" => "User Succesfully Login",
                "data" => $user,
                "token" => $token
            ]);

        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }

    public function me()
    {
        return response()->json(Auth('api')->user());
    }
}
