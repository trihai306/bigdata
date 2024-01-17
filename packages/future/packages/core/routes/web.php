<?php

use Future\Core\Http\Controllers\MenuController;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => ['web','guest']], function () {
    Route::get('admin/login', [\Future\Core\Http\Controllers\AuthController::class,'login'])->name('login');
    Route::get('admin/logout', [\Future\Core\Http\Controllers\AuthController::class,'logout'])->name('logout');
    Route::get('admin/forgot', [\Future\Core\Http\Controllers\AuthController::class,'forgotPassword'])->name('forgot-password');
});
Route::group(config('core.core.route'), function () {
    $namespace = 'App\\Future\\';
    $classes = array_filter(get_declared_classes(), function($className) use ($namespace) {
        return str_starts_with($className, $namespace);
    });
    Route::resource('menu', MenuController::class)->names('menu');
});
