<?php
use Illuminate\Support\Facades\Route;


Route::get('admin/login', 'AuthController@login')->name('login');
Route::get('admin/logout', 'AuthController@logout')->name('logout');
