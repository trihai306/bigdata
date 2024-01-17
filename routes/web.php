<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
route::get('/', function () {
//    $message = 'Hello, this is a test message!';
//    $userId = 1; // Replace with the actual user ID
//    $sender = Auth::user()->name;
//
//    event(new \App\Events\UserMessageEvent($userId, $message, $sender));

    // ID của người dùng nhận thông báo
//dd('abc');
//    $userId = 1;
//
//    $user = User::findOrFail($userId);
//    $notification = new UserNotification($userId, 'Tiêu đề thông báo', 'Nội dung thông báo');
//    $user->notify($notification);
    return view('welcome');
});

//Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
//    \UniSharp\LaravelFilemanager\Lfm::routes();
//});

//Route::resource('users', UserResource::class);
