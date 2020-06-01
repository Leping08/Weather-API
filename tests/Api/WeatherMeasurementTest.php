<?php


namespace Tests\Api;


use App\Pressure;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class WeatherMeasurementTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function is_will_save_data_to_the_database_when_the_store_route_is_hit()
    {
        $data = [
            'temp' => 88.193460815522,
            'pressure' => 1016.9552337327,
            'humidity' => 58,
            'event_time' => '2019-05-07 00:54:52.145026'
        ];

        $this->post(route('measurement.store', ['api_token' => config('api.key')]), $data)
            ->assertStatus(200);
    }
}