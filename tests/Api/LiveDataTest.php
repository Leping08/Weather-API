<?php

namespace Tests\Feature;

use App\Humidity;
use App\Pressure;
use App\Temperature;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class LiveDataTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_responds_with_the_last_hour_of_pressure_data()
    {
        $old_data = factory(Pressure::class)->create([
            'measurement_time' => Carbon::now()->subHour()->subMinutes(10)
        ]);

        $new_data = factory(Pressure::class)->create();

        $response = $this->post(route('live'), ['measurement' => 'pressure']);

        $response->assertStatus(200)
            ->assertDontSee($old_data->millibars)
            ->assertSee($new_data->millibars);
    }

    /** @test */
    public function it_responds_with_the_last_hour_of_temperature_data()
    {
        $old_data = factory(Temperature::class)->create([
            'measurement_time' => Carbon::now()->subHour()->subMinutes(10)
        ]);

        $new_data = factory(Temperature::class)->create();

        $response = $this->post(route('live'), ['measurement' => 'temperature']);

        $response->assertStatus(200)
            ->assertDontSee($old_data->degrees)
            ->assertSee($new_data->degrees);
    }

    /** @test */
    public function it_responds_with_the_last_hour_of_humidity_data()
    {
        $old_data = factory(Humidity::class)->create([
            'measurement_time' => Carbon::now()->subHour()->subMinutes(10)
        ]);

        $new_data = factory(Humidity::class)->create();

        $response = $this->post(route('live'), ['measurement' => 'humidity']);

        $response->assertStatus(200)
            ->assertDontSee($old_data->percentage)
            ->assertSee($new_data->percentage);
    }
}
