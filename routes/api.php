<?php

use App\Events\UserPrivateMessageEvent;
use App\Http\Controllers\API\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('/reset-password', [AuthController::class, 'resetPassword']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/profile', [AuthController::class, 'getProfile']);
    Route::put('/edit-profile', [AuthController::class, 'editProfile']);
    Route::put('/change-password', [AuthController::class, 'changePassword']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::post('/pusher/auth', function (Illuminate\Http\Request $request) {
    $pusher = new Pusher\Pusher(
        'app-key',
        'app-secret',
        'app-key',
        [
            'cluster' => 'ap1',
            'useTLS' => true
        ]
    );

    return $pusher->socket_auth($request->input('channel_name'), $request->input('socket_id'))['auth'];
});

