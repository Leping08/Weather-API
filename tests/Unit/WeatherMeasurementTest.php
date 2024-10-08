<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WeatherMeasurementTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_will_save_data_to_the_database_when_the_store_route_is_hit()
    {
        $data = [
            'temp' => 88.193460815522,
            'pressure' => 1016.9552337327,
            'humidity' => 58,
            'event_time' => '2019-05-07 00:54:52.145026'
        ];

        $this->post(route('measurement.store', ['api_key' => config('api.key')]), $data)
            ->assertStatus(200);
    }

    // It will reject if the pressue is under 800
    public function test_it_will_reject_data_with_pressure_under_800()
    {
        $data = [
            'temp' => 88.193460815522,
            'pressure' => 799.9999999999,
            'humidity' => 58,
            'event_time' => '2019-05-07 00:54:52.145026'
        ];

        $this->post(route('measurement.store', ['api_key' => config('api.key')]), $data)
            ->assertStatus(422);
    }
}
