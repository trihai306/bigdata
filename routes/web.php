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
//    $fcmMessage = [
//        "message" => [
//            "token" => "ezB0kcjeQcqm7ZuduSB3vF:APA91bExHD3KsSSLWspnJFH_OG0erIhwnyn27qL5IUpL5KKz0YUMIXFdWLAVJer0dIUTb0hTLM9On3pjm1GFBRVmCQAmEPunj_ZMalWqJd88h6-yqrAF2hvKsIzbXAQ5e6lnm3usJzdP",
//            "notification" => [
//                "body" => "Oke",
//                "title" => "Push notification Dina app"
//            ]
//        ]
//    ];
//
//    $response = sendFCMNotification($accessToken, $fcmMessage);
    return view('welcome');
});
