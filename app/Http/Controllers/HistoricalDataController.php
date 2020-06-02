<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class HistoricalDataController extends Controller
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
                Rule::in(['day', 'week', 'month', 'year'])
            ]
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        //Build the model ex: '\App\Pressure'
        $model = "\\App\\" . Str::title($request->get('measurement'));

        $method = "sub" . Str::title($request->get('time_frame'));

        //Return the last hour of data
        return $model::where('measurement_time', '>=', Carbon::now()->$method()->toDateTimeString())
            ->downsample(.5)
            ->get();
    }
}
