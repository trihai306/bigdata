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
        $name = str_replace('Resource', '', $classBasename);
        $name = Str::lower($name) . 's';
        $className = 'App\\Future\\' . $classBasename;
        $resource = new $className();
        $routeName = $resource->getRouteName() ?? $name;
        $only = [];
        if($resource->form){
            $only[] = 'create';
            $only[] = 'edit';
        }
        if($resource->table){
            $only[] = 'index';
        }

        Route::resource($routeName, $className)->only($only)->names($name);
        $methods = get_class_methods($className);
        $remove = ['__construct', 'getRouteName', 'index', 'create', 'store', 'show', 'edit', 'update', 'destroy',
            'callAction','middleware','validate','validateWith','authorize','getMiddleware','__call','authorizeForUser','authorizeResource','validateWithBag'];
        $methods = array_diff($methods, $remove);
        foreach ($methods as $method) {
            //lấy ra các phương thức của class public
            if (strpos($method, '__') !== 0) {
                $name = $routeName . '.' . $method;
                route::get( $routeName . '/' . $method, $className . '@' . $method)->name($name);

            }
        }
    });
});
