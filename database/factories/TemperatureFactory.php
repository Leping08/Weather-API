<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;
use Carbon\Carbon;
use App\Temperature;

$factory->define(Temperature::class, function (Faker $faker) {
    return [
        'degrees' => $faker->randomFloat(6, 30, 120),
        'measurement_time' => Carbon::now()
    ];
});
