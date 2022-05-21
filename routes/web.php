<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
/*
Route::get('login', ['as' => 'auth.login', 'uses' => 'Auth\AuthController@showLoginForm']);
Route::post('login', ['as' => 'auth.login', 'uses' => 'Auth\AuthController@login']);
Route::get('logout', ['as' => 'auth.logout', 'uses' => 'Auth\AuthController@logout']);

// Registration Routes...
Route::get('register', ['as' => 'auth.register', 'uses' => 'Auth\AuthController@showRegistrationForm']);
Route::post('register', ['as' => 'auth.register', 'uses' => 'Auth\AuthController@register']);

// Password Reset Routes...
Route::get('password/reset/{token?}', ['as' => 'auth.password.reset', 'uses' => 'Auth\PasswordController@showResetForm']);
Route::post('password/email', ['as' => 'auth.password.email', 'uses' => 'Auth\PasswordController@sendResetLinkEmail']);
Route::post('password/reset', ['as' => 'auth.password.reset', 'uses' => 'Auth\PasswordController@reset']);
*/
Route::get('/home', [\App\Http\Controllers\API\HomeController::class, 'index'])->name('home');
Route::group(
    [
        'prefix' => '/shop'
    ],
    function () {
        Route::get('/all', [\App\Http\Controllers\FrontEnd\ShopController::class, 'index'])->name('shop_all');
        Route::get('/get/{id}', [\App\Http\Controllers\FrontEnd\ShopController::class, 'one'])->name('shop_one_get');
        Route::post('/edit/{id}', [\App\Http\Controllers\FrontEnd\ShopController::class, 'edit'])->name('shop_one_edit');
        Route::post('/delete/{id}', [\App\Http\Controllers\FrontEnd\ShopController::class, 'delete'])->name('shop_one_delete');
    }
);

Route::get('/leaders')->name('leaders');
Route::get('/points')->name('points');
Route::get('/family')->name('family');
Route::get('/logs')->name('logs');
