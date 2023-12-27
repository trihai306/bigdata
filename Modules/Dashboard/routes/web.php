<?php

use Illuminate\Support\Facades\Route;
use Modules\Dashboard\app\Http\Controllers\DashboardController;

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
    'as' => 'admin.',
], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
});
