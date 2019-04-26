<?php

namespace App\Events;

use App\Humidity;
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


    public function __construct(Temperature $temperature, Humidity $humidity)
    {
        $this->humidity = $humidity;
        $this->temperature = $temperature;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('weather');
    }
}
