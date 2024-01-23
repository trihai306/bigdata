<?php


Route::group(config('core.core.route'), function () {
 Route::get('messages', [\Future\Messages\Http\Controllers\MessageController::class,'index'])->name('messages.index');
});
