<?php

namespace App\Http\Controllers;

use App\Events\WeatherMeasured;
use App\Humidity;
use App\Pressure;
use App\Temperature;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class WeatherMeasurement extends Controller
{
    public function temperature()
    {
        return $this->lastHourOfData('temperatures');
    }

    public function pressure()
    {
        return $this->lastHourOfData('pressures');
    }

    public function humidity()
    {
        return $this->lastHourOfData('humidities');
    }

    public function lastHourOfData(string $table)
    {
        $data = DB::table($table)
                    ->where('created_at', '>=', Carbon::now()->subMinute(10)->toDateTimeString())
                    ->get();
        return $this->downSample($data);
    }

    public function downSample(Collection $collection)
    {
        $downSamplePercent = 2;
        $count = $collection->count();
        $nth = ($downSamplePercent * .01) * $count;
        return $collection->nth(round($nth));
    }
    
    public function store(Request $request)
    {
        Log::info("Request: ". print_r($request->all(), true));

        $data = $request->validate([
            'temp' => 'nullable|numeric',
            'humidity' => 'nullable|numeric',
            'pressure' => 'nullable|numeric',
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
