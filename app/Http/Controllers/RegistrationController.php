<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRegistrationRequest;
use App\Models\User;
use Illuminate\Validation\ValidationException;


class RegistrationController extends Controller
{
    public function signup (StoreRegistrationRequest $request) {

        try {
            $validatedData = $request->validated();
            return response()->json([
                'message' => 'Registration successful!',
            ], 201);

            User::create($validatedData);

        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed.',
                'errors' => $e->errors(), // Pesan error dikembalikan dalam bentuk array
            ], 422);
        }
       
    }
}