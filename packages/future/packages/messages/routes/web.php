<?php


Route::group(config('core.core.route'), function () {
   Route::get('/messages', function () {
       return view('future::chat');
   });
});
