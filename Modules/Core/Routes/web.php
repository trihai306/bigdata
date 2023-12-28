<?php
use Illuminate\Support\Facades\Route;
use Modules\Core\Http\Controllers\AuthController;


Route::group(['middleware' => ['web','guest']], function () {
    Route::get('admin/login', 'AuthController@login')->name('login');
    Route::get('admin/logout', 'AuthController@logout')->name('logout');
    Route::get('admin/forgot', 'AuthController@forgotPassword')->name('forgot-password');
});
