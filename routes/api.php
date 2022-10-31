<?php

use App\Http\Controllers\UserController;
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

    Route::group(['prefix' => 'weather-requests'], function() {
        Route::get('/', [\App\Http\Controllers\WeatherRequestController::class, 'index']);
        Route::get('/{weatherRequest}', [\App\Http\Controllers\WeatherRequestController::class, 'show']);
        Route::post('/', [\App\Http\Controllers\WeatherRequestController::class, 'create']);
        Route::delete('/{weatherRequest}', [\App\Http\Controllers\WeatherRequestController::class, 'delete']);
    });
});
