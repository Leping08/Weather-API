<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class LiveDataController extends Controller
{
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'measurement' => [
                'required',
                Rule::in(['pressure', 'temperature', 'humidity'])
            ]
        ]);


        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        //Build the model ex: '\App\Pressure'
        $model = "\\App\\" . Str::title($request->get('measurement'));

        //TODO remove created_at and updated_at from the live data

        //Return the last hour of data
        return $model::where('measurement_time', '>=', Carbon::now()->subHour()->toDateTimeString())
            ->get();
    }
}
