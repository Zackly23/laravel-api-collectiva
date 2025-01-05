<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegistrationController extends Controller
{
    public function signup (Request $request) {
        
        try{
            $validator = Validator::make($request->all(), [
                'first_name' => 'required|string|max:50', // Nama depan wajib diisi, string, dan max 50 karakter
                'last_name' => 'required|string|max:50', // Nama belakang opsional, string, dan max 50 karakter
                'email' => 'required|email|unique:users,email', // Email wajib, valid, unik di tabel users
                'password' => 'required|string', // Password wajib, minimal 8 karakter, dan dikonfirmasi
            ]);
            User::create($validator->validated());

            return response()->json(['message' => 'User created successfully'], 201);

        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }
}