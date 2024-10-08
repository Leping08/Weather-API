<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pressure extends Model
{
    use HasFactory;

    protected $fillable = [
        'millibars',
        'measurement_time'
    ];

    protected $dates = [
        'measurement_time',
    ];
}
