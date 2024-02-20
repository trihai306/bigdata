<?php

use Illuminate\Support\Facades\Route;
use Modules\Bank\Http\Controllers\BankController;


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

Route::group(['middleware' => 'auth', 'prefix' => 'banks', 'as'=>'banks.'], function () {
    Route::get('remitly', [BankController::class, 'nn1'])->name('nn1');
    Route::get('ria', [BankController::class, 'nn2'])->name('nn2');
    Route::get('send-wave', [BankController::class, 'nn3'])->name('nn3');
    Route::get('westen-union', [BankController::class, 'nn4'])->name('nn4');
    Route::get('nn5', [BankController::class, 'nn5'])->name('nn5');
    Route::get('techcombank', [BankController::class, 'techcombank'])->name('techcombank');
});
