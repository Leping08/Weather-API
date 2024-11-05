<?php

namespace App\Models;

use Carbon\Carbon;
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

    public static function getPressureClosestToTimeStamp($timestamp)
    {
        Carbon::parse($timestamp)->format('Y-m-d H:i:s');

        return self::where('measurement_time', '>=', $timestamp)
            ->orderBy('measurement_time', 'asc')
            ->first();
    }
}
