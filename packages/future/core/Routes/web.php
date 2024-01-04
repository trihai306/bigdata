<?php

use Future\Core\Http\Controllers\MenuController;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => ['web','guest']], function () {
    Route::get('admin/login', [\Future\Core\Http\Controllers\AuthController::class,'login'])->name('login');
    Route::get('admin/logout', [\Future\Core\Http\Controllers\AuthController::class,'logout'])->name('logout');
    Route::get('admin/forgot', [\Future\Core\Http\Controllers\AuthController::class,'forgotPassword'])->name('forgot-password');
});
Route::group([
    'middleware' => [ 'auth'],
    'prefix' => 'admin',
    'as' => 'admin.'
], function () {
    Route::resource('menu', MenuController::class)->names('menu');
});
