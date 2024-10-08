<?php

namespace Tests\Feature;

use App\Models\Humidity;
use App\Models\Pressure;
use App\Models\Temperature;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class LiveDataTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_responds_with_the_last_hour_of_pressure_data()
    {
        $old_data = Pressure::factory()->create([
            'measurement_time' => Carbon::now()->subHour()->subMinutes(10)
        ]);

        $new_data = Pressure::factory()->create();

        $data = [
            'measurement' => 'pressure',
            'time_frame' => 'live',
            'api_key' => env('API_KEY')
        ];

        // make http call to the route live with the data
        $this->get(route('live', $data))
            ->assertStatus(200)
            ->assertDontSee($old_data->millibars)
            ->assertSee($new_data->millibars);
    }

    public function test_it_responds_with_the_last_hour_of_temperature_data()
    {
        $old_data = Temperature::factory()->create([
            'measurement_time' => Carbon::now()->subHour()->subMinutes(10)
        ]);

        $new_data = Temperature::factory()->create();

        $data = [
            'measurement' => 'temperature',
            'time_frame' => 'live',
            'api_key' => env('API_KEY')
        ];

        $this->get(route('live', $data))
            ->assertStatus(200)
            ->assertDontSee($old_data->degrees)
            ->assertSee($new_data->degrees);
    }

    public function test_it_responds_with_the_last_hour_of_humidity_data()
    {
        $old_data = Humidity::factory()->create([
            'measurement_time' => Carbon::now()->subHour()->subMinutes(10)
        ]);

        $new_data = Humidity::factory()->create();

        $data = [
            'measurement' => 'humidity',
            'time_frame' => 'live',
            'api_key' => env('API_KEY')
        ];

        $this->get(route('live', $data))
            ->assertStatus(200)
            ->assertDontSee($old_data->percentage)
            ->assertSee($new_data->percentage);
    }
}
