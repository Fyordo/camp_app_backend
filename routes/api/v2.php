<?php

use Illuminate\Support\Facades\Route;

Route::group(
    [
        'prefix' => '/v2'
    ],
    function () {
        Route::apiResource('/admin', \App\Http\Controllers\APIv2\AdminController::class);

        Route::apiResource('/child', \App\Http\Controllers\APIv2\ChildController::class);

        Route::apiResource('/event', \App\Http\Controllers\APIv2\EventController::class);

        Route::apiResource('/review', \App\Http\Controllers\APIv2\ReviewController::class);

        Route::apiResource('/leader', \App\Http\Controllers\APIv2\LeaderController::class);

        Route::apiResource('/operation', \App\Http\Controllers\APIv2\OperationController::class);

        Route::apiResource('/parent', \App\Http\Controllers\APIv2\ParentController::class);

        Route::apiResource('/product', \App\Http\Controllers\APIv2\ProductController::class);

        Route::apiResource('/sanitary', \App\Http\Controllers\APIv2\SanitaryController::class);

        Route::apiResource('/shop', \App\Http\Controllers\APIv2\ShopController::class);

        Route::apiResource('/staff', \App\Http\Controllers\APIv2\StaffController::class);

        Route::apiResource('/user', \App\Http\Controllers\APIv2\UserController::class);
    }
);
