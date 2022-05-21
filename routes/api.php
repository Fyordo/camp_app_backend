<?php

use App\Http\Controllers\API\ChatsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(
    [
        'prefix' => '/child'
    ],
    function () {
        Route::get('{id}', [\App\Http\Controllers\API\ChildController::class, 'get']);
        Route::get('', [\App\Http\Controllers\API\ChildController::class, 'all']);
        Route::post('/list', [\App\Http\Controllers\API\ChildController::class, 'list']);
        Route::post('/coordinates', [\App\Http\Controllers\API\ChildController::class, 'updateCoordinates']);
    }
);

Route::group(
    [
        'prefix' => '/parent'
    ],
    function () {
        Route::get('{id}', [\App\Http\Controllers\API\ParentController::class, 'get']);
        Route::get('', [\App\Http\Controllers\API\ParentController::class, 'all']);
    }
);

Route::group(
    [
        'prefix' => '/leader'
    ],
    function () {
        Route::get('{id}', [\App\Http\Controllers\API\LeaderController::class, 'get']);
        Route::get('', [\App\Http\Controllers\API\LeaderController::class, 'all']);
    }
);

Route::group(
    [
        'prefix' => '/staff'
    ],
    function () {
        Route::get('{id}', [\App\Http\Controllers\API\StaffController::class, 'get']);
        Route::get('', [\App\Http\Controllers\API\StaffController::class, 'all']);
    }
);

Route::group(
    [
        'prefix' => '/auth'
    ],
    function () {
        Route::post('login', [\App\Http\Controllers\API\AuthController::class, 'login']);
    }
);

Route::group(
    [
        'prefix' => '/product'
    ],
    function () {
        Route::get('{id}', [\App\Http\Controllers\API\ProductController::class, 'get']);
        Route::get('', [\App\Http\Controllers\API\ProductController::class, 'all']);
        Route::post('/buy', [\App\Http\Controllers\API\ProductController::class, 'buy']);
    }
);

Route::group(
    [
        'prefix' => '/sanitary'
    ],
    function () {
        Route::get('{id}', [\App\Http\Controllers\API\SanitaryNoteController::class, 'get']);
        Route::get('', [\App\Http\Controllers\API\SanitaryNoteController::class, 'all']);
        Route::post('/add', [\App\Http\Controllers\API\SanitaryNoteController::class, 'add']);
    }
);

Route::group(
    [
        'prefix' => '/operations'
    ],
    function () {
        Route::get('{id}', [\App\Http\Controllers\API\OperationController::class, 'get']);
        Route::post('', [\App\Http\Controllers\API\OperationController::class, 'all']);
        Route::post('/day', [\App\Http\Controllers\API\OperationController::class, 'day']);
    }
);

Route::group(
    [
        'prefix' => '/event'
    ],
    function () {
        Route::get('{id}', [\App\Http\Controllers\API\EventController::class, 'get']);
        Route::get('', [\App\Http\Controllers\API\EventController::class, 'all']);
    }
);

Route::group(
    [
        'prefix' => '/socket'
    ],
    function () {
        Route::group(
            [
                'prefix' => '/chat'
            ],
            function () {
                Route::get('/messages', [ChatsController::class, 'fetchMessages']);
                Route::post('/messages', [ChatsController::class, 'sendMessage']);
            }
        );
    }
);
