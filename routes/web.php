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
    $accessToken = 'ya29.c.c0AY_VpZg3xGH91Tb6nAO2HeZSLmFzbzwTdvZxPkU6c_qMv-aGbA5GEvvqBqPdt3DYEkq2Jc_EyN3qN9BI97jhNGzwFR_na0zXySlVTxaVz6JDj3tbyGHae37K8j3VEdVLvZQgRM7-bu9zxW1XQWnN7EL6tQJWUKvlNdLUHZjCw-chYH2f4UcxrjzzpMVQzitVObQEXpXKCUGSx_aFrDSK9AzziWeOzVSvVH08qDSFJ4drfg7G_gVnJPslrr0X7DxabrVIMzgMKiSfpnyiY7o5eherfoW3O2ep_ZBQUsafnlyMnkaSZKtiVucY9yZZIJWuGSbBndXcIvQEQ-Qse6XfcDKvcsIPxG2bX5lugHpOmHp41sjsp8Kq-gN383DUpge0jiUzc7ml58yRIc-3df_Q-vpQY_pxY9nI-6RuofOQQVIkaUJF91ktwQlXxxcdm9O8e4J9YJhn9_BxdFJ93nfOb3JVf5a-hkf_WFYkxMqXkfRyyQsJjtb23O7Yhl2jMk5m4X5s9BXIgS1F5FdBc1QXnrWmO_hZyvbxe22FJ7rV8hSI19ko4RR9hXO1ehRjgipMb5gmb6fsZ_h1nvikRpbhVt32bvdbgI_v4JnZU8YQeetqBarb6qgb6W9tup_md1IaFbF-xwUOscgbZpBw3Vs4RJrtwcg8b4yZc1skte-b4SOiqZ4kOrWvlycrg3X0d6swac4n0gY1eWl7qIRQW8IJ68pgtvbIwgjqzWSwoIxVe6ZlzsRt_ian5ow2pJ5mXXJjlUbeklrVzMmhZal_M7V2O0w5hJmU0-ybqfn0l3WwQebXt9X068xevsgZh2t7mWuSs-qxynVkow_XQn9wzmgIZOa2--bk1romy47mav7Zq7veMS_Mn54BMXMyqxOh9jnOFYufaFVoW-UXrzdfmOrJ12O4z2pxB9Zg6rahj1U9uzB_aFbuBcfu2yUkBjOO0fFoOpbozFMi_0ym__1tptQWJcq2getsa2sfxxtwZnfQ5Ydr3pO8ZgfwpnM';
    $fcmMessage = [
        "message" => [
            "token" => "ezB0kcjeQcqm7ZuduSB3vF:APA91bExHD3KsSSLWspnJFH_OG0erIhwnyn27qL5IUpL5KKz0YUMIXFdWLAVJer0dIUTb0hTLM9On3pjm1GFBRVmCQAmEPunj_ZMalWqJd88h6-yqrAF2hvKsIzbXAQ5e6lnm3usJzdP",
            "notification" => [
                "body" => "Oke",
                "title" => "Push notification Dina app"
            ]
        ]
    ];

    $response = sendFCMNotification($accessToken, $fcmMessage);
    return view('welcome');
});
