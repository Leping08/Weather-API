<?php

namespace App\Events;

use App\Humidity;
use App\Pressure;
use App\Temperature;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class WeatherMeasured implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $temperature;

    public $humidity;

    public $pressure;

    public function __construct(Temperature $temperature, Humidity $humidity, Pressure $pressure)
    {
        $this->humidity = $humidity;
        $this->temperature = $temperature;
        $this->pressure = $pressure;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('weather');
    }
}
