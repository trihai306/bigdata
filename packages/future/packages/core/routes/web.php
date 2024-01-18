<?php

use Future\Core\Http\Controllers\MenuController;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => ['web', 'guest']], function () {
    Route::get('admin/login', [\Future\Core\Http\Controllers\AuthController::class, 'login'])->name('login');
    Route::get('admin/logout', [\Future\Core\Http\Controllers\AuthController::class, 'logout'])->name('logout');
    Route::get('admin/forgot', [\Future\Core\Http\Controllers\AuthController::class, 'forgotPassword'])->name('forgot-password');
});
Route::group(config('core.core.route'), function () {
    $directory = app_path('Future');
    $files = File::allFiles($directory);

    $filesCollection = collect($files);

    $resourceFiles = $filesCollection->filter(function ($file) {
        return Str::endsWith($file->getFilename(), 'Resource.php');
    });

    $resourceFiles->each(function ($file) {
        $classBasename = str_replace(['/', '.php'], ['\\', ''], $file->getRelativePathName());
        //xóa chuỗi classbasename thành 2 bỏ phần đuôi Resource.php và chữ không in hoa
        $name = str_replace('Resource', '', $classBasename);
        $name = Str::lower($name) . 's';
        $className = 'App\\Future\\' . $classBasename;
        $resource = new $className();
        $routeName = $resource->getRouteName() ?? $name;
        Route::resource($routeName, $className)->only(['index', 'create', 'edit'])->names($name);
    });
});
