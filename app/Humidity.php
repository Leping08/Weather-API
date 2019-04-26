<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * An Eloquent Model: 'Humidity'
 *
 * @property integer $id
 * @property float $percentage
 * @property Carbon $measurement_time
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */

class Humidity extends Model
{
    protected $fillable = [
        'percentage',
        'measurement_time'
    ];

    protected $dates = [
        'measurement_time',
    ];
}
