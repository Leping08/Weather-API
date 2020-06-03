<?php

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

/* @see API::handle() */
Route::middleware('api_token')->group(function () {
    /* @see MeasurementController::store() */
    Route::post('/weather/{api_key}', 'MeasurementController@store')->name('measurement.store');
});

/* @see Domain::handle() */
Route::middleware('domain')->group(function () {
    /* @see WeatherDataController::index() */
    Route::get('/weather-data', 'WeatherDataController@index')->name('live');
});

