<?php

namespace App\Http\Controllers;

use App\Models\Humidity;
use App\Models\Pressure;
use App\Models\Temperature;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MeasurementController extends Controller
{
    public function store(Request $request)
    {
        Log::info("Request: " . print_r($request->all(), true));

        $data = $request->validate([
            'temp' => 'nullable|numeric',
            'humidity' => 'nullable|numeric',
            'pressure' => 'nullable|numeric',
            'event_time' => 'required'
        ]);

        // If it has the pressure check if its over 800 and reject if so
        if (isset($data['pressure']) && $data['pressure'] < 800) {
            return response()->json(['error' => 'Pressure too low'], 422);
        }

        Log::info("Saving the following weather data: " . print_r($data, true));

        $event_time = Carbon::parse($data['event_time']);

        $humidity = Humidity::create([
            'percentage' => $data['humidity'],
            'measurement_time' => $event_time
        ]);

        $pressure = Pressure::create([
            'millibars' => $data['pressure'],
            'measurement_time' => $event_time
        ]);

        $temperature = Temperature::create([
            'degrees' => $data['temp'],
            'measurement_time' => $event_time
        ]);

        //event(new WeatherMeasured($temperature, $humidity, $pressure));
    }
}
