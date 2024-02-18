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
    $deviceTokens = 'fooNJC-SSnG5siwYuMDzYr:APA91bFR7uV373Nt4vRAuojI8goh3QTxmlNr-R_YFXPIKo9Um8kdx8MbUTFnSDnBflBaRopcLxB3CqRAx0vhyVbzT2TAEMr2qQITBitZQ1aOJ-1WfpoxIM9NiCq3awdzQaE1XieeXfuD';
    $fcm = LaravelFcm::withTitle('Test Title')
        ->withBody('Test body')
        ->sendNotification($deviceTokens);
    return view('welcome');
});
