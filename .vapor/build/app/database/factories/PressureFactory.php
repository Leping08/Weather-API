<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Carbon\Carbon;
use App\Pressure;

$factory->define(Pressure::class, function (Faker $faker) {
    return [
        'millibars' => $faker->randomFloat(6, 900, 1080),
        'measurement_time' => Carbon::now()
    ];
});
