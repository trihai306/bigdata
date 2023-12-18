<?php

use Illuminate\Support\Facades\Route;
use Modules\Permission\app\Http\Controllers\PermissionController;

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
    'prefix' => 'admin',
    'middleware' => [ 'auth'],
    'as' => 'admin.'
], function () {
    Route::resource('permissions', PermissionController::class);
    Route::get('roles', [PermissionController::class, 'role'])->name('roles');
    Route::get('roles/{id}', [PermissionController::class, 'showRole'])->name('roles.show');
});
