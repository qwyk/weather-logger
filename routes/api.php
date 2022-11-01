<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WeatherRequestController;
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

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [UserController::class, 'show']);

    Route::group(['prefix' => 'weather-requests'], static function () {
        Route::get('/', [WeatherRequestController::class, 'index']);
        Route::get('/{weatherRequest}', [WeatherRequestController::class, 'show']);
        Route::post('/', [WeatherRequestController::class, 'create']);
        Route::delete('/{weatherRequest}', [WeatherRequestController::class, 'delete']);
        Route::group(['prefix' => '/{weatherRequest}/comments'], static function () {
            Route::get('/', [WeatherRequestController::class, 'comments']);
            Route::post('/', [WeatherRequestController::class, 'createComment']);
        });
    });

    Route::group(['prefix' => 'comments'], static function () {
        Route::delete('/{comment}', [CommentController::class, 'delete']);
    });
});
