<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\RegistrationController;


Route::prefix('v1')->group(function () {
    Route::post('/sign-up',[RegistrationController::class, 'signup']);
    Route::post('/login', [AuthController::class, 'login']);

    Route::middleware(['auth.api'])->group(function () {
        Route::get('/me', [AuthController::class, 'me']);

        Route::post('/logout', [AuthController::class, 'logout']);
    });
});
