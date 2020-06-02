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

/* @see MeasurementController::store() */
Route::middleware('api_token')->group(function () {
    Route::post('/weather/{api_key}', 'MeasurementController@store')->name('measurement.store');
});

/* @see LiveDataController::index() */
Route::middleware('domain')->group(function () {
    Route::post('/live', 'LiveDataController@index')->name('live');

    Route::post('/historical', 'HistoricalDataController@index')->name('history');
});

