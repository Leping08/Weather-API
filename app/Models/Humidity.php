<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Humidity extends Model
{
    use HasFactory;

    protected $fillable = [
        'percentage',
        'measurement_time'
    ];

    protected $dates = [
        'measurement_time',
    ];
}
