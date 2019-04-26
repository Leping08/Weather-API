<?php

namespace App\Http\Controllers;

use App\Events\WeatherMeasured;
use App\Humidity;
use App\Pressure;
use App\Temperature;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WeatherMeasurement extends Controller
{
    public function store(Request $request)
    {
        Log::info("Request: ". print_r($request->all(), true));

        $data = $request->validate([
            'temp' => 'required|numeric',
            'humidity' => 'required|numeric',
            'pressure' => 'required|numeric',
            'event_time' => 'required'
        ]);

        Log::info("Request: ". print_r($data, true));

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

        event(new WeatherMeasured($temperature, $humidity, $pressure));
    }
}
