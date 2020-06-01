<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Carbon\Carbon;
use App\Humidity;

$factory->define(Humidity::class, function (Faker $faker) {
    return [
        'percentage' => $faker->randomFloat(2, 1, 99),
        'measurement_time' => Carbon::now()
    ];
});
