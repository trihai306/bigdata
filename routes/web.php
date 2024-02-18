<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redis;
use SmirlTech\LaravelFcm\Facades\LaravelFcm;
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
    $fcm = LaravelFcm::withTitle('Test Title')
        ->withBody('Test body')
        ->sendMessage([
            "dZKW30otSSCHJuEGvICcVc:APA91bEBYIGzdH1FpSj7d5iP5u0tCIR3RZRYzXqk0Zl0_99g03E6ZV5augTnKuU3-m-df0A1UI84nnFFs8fWeQJ5FEOYZcZ4VeoI22uuuyh8XsSLwDgPppmEitWGGLPZfQHpoVznkE2L"
        ]);
    return view('welcome');
});
