<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * An Eloquent Model: 'Pressure'
 *
 * @property integer $id
 * @property float $millibars
 * @property Carbon $measurement_time
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */

class Pressure extends Model
{
    protected $fillable = [
        'millibars',
        'measurement_time'
    ];

    protected $dates = [
        'measurement_time',
    ];
}
