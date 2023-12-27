<?php

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

use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'auth',
    'prefix' => 'admin',
    'as' => 'admin.'
], function () {
    Route::get('modules', 'ModulesController@index')->name('modules.index');
    Route::post('modules/{name}/toggle', 'ModulesController@toggleModule')->name('modules.toggle');
});
