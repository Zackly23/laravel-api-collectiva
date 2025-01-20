<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\AgendaController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\TestController;

Route::prefix('v1')->group(function () {
    Route::post('/sign-up',[RegistrationController::class, 'signup']);
    Route::post('/login', [AuthController::class, 'login']);

    Route::middleware(['auth.api'])->group(function () {
        Route::get('/me', [AuthController::class, 'me']);

        Route::post('/logout', [AuthController::class, 'logout']);
    });

    Route::get('/agendas', [AgendaController::class, 'getAllAgendas']);
    Route::post('/agenda', [AgendaController::class, 'storeAgenda']);

    Route::get('/private-chat', [MessageController::class, 'getPrivateMessage']);

    Route::get('/test/{user}', [ChatController::class, 'getListGroupMessage']);
    Route::get('/test-group-id/{groupChatId}', [ChatController::class, 'getGroupChatById']);
    Route::get('/test-private-id/{user}/{sender}', [ChatController::class, 'getPrivateChatById']);

    Route::get('/test-private/{user}', [ChatController::class, 'getListPrivateMessage']);
    Route::get('/testbodychat/{user}/{tab}', [ChatController::class, 'getChatMessage']);

    Route::get('/chats', [TestController::class, 'testChat']);
});
