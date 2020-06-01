<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * An Eloquent Model: 'Temperature'
 *
 * @property integer $id
 * @property float $degrees
 * @property Carbon $measurement_time
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */

class Temperature extends Model
{
    protected $fillable = [
        'degrees',
        'measurement_time'
    ];

    protected $dates = [
        'measurement_time',
    ];
}
