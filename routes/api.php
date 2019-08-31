<?php

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::middleware('api_token')->group(function () {
    Route::post('/weather/{api_token}', 'WeatherMeasurement@store');
});

/* @see WeatherMeasurement::pressure() */
Route::get('/pressure', 'WeatherMeasurement@pressure');

/* @see WeatherMeasurement::temperature() */
Route::get('/temperature', 'WeatherMeasurement@temperature');

/* @see WeatherMeasurement::humidity() */
Route::get('/humidity', 'WeatherMeasurement@humidity');

