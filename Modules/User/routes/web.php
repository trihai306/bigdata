<?php

use Illuminate\Support\Facades\Route;
use Modules\User\app\Http\Controllers\UserController;
use Modules\User\app\Http\Controllers\UserResource;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group([
    'middleware' => ['auth'],
    'prefix' => 'admin',
    'as' => 'admin.'
], function () {
//    Route::resource('users', UserController::class)->names('user');
    Route::resource('users', UserResource::class)->names('user');
});
