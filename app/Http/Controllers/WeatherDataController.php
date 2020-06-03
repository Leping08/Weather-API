<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class WeatherDataController extends Controller
{
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'measurement' => [
                'required',
                Rule::in(['pressure', 'temperature', 'humidity'])
            ],
            'time_frame' => [
                'required',
                Rule::in(['live', 'day', 'week', 'month', 'year'])
            ]
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        //Build the model ex: '\App\Pressure'
        $model = "\\App\\" . Str::title($request->get('measurement'));

        //Set up the time frame of the db query
        if ($request->get('time_frame') === 'live') {
            $method = 'subHour';
        } else {
            $method = "sub" . Str::title($request->get('time_frame'));
        }

        //Return the time frame of data
        $data = $model::where('measurement_time', '>=', Carbon::now()->$method()->toDateTimeString())
            ->get();

        //Downsample if the data count is over 500
        if ($data->count() >= 500) {
            return $data->downsamle(0.5);
        } else {
            return $data;
        }
    }
}
