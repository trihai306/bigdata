<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redis;
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

    $deviceToken = 'fb9gE7HzRgGRJzmNRDF9pH:APA91bFcquJ_bcb3PcNkj4rO1o_1F8e3gNzWCIc6R33XnpgKZaUVNQGfAc8G3yx68lftyhintSD5PvA2ILpm0RWSbIAzDtRzYsHmi-uVn1xGD12rC-iLSrBcAA790YEBbaGwHGrfU9Za';
    $title = 'Hello World';
    $body = 'This is a test notification';
    $data = ['key1' => 'value1', 'key2' => 'value2'];

    $result = sendFirebaseNotification($deviceToken, $title, $body, $data);

    dd($result);
    return view('welcome');
});
