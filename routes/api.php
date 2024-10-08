<?php

use App\Http\Controllers\MeasurementController;
use App\Http\Controllers\WeatherDataController;
use App\Http\Middleware\ApiKey;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

/* @see API::handle() */
Route::middleware([ApiKey::class])->group(function () {
    /* @see MeasurementController::store() */
    Route::post('/weather/{api_key}', [MeasurementController::class, 'store'])->name('measurement.store');
});

Route::get('/weather-data', [WeatherDataController::class, 'index'])->name('live');
