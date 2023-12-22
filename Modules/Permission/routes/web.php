<?php

use Illuminate\Support\Facades\Route;
use Modules\Permission\app\Http\Controllers\PermissionResource;

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
    Route::resource('permissions', \Modules\Permission\app\Http\Controllers\PermissionResource::class);
    Route::get('roles', [PermissionResource::class, 'role'])->name('roles');
    Route::get('roles/{id}', [PermissionResource::class, 'showRole'])->name('roles.show');
});
