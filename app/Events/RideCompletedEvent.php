<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RideCompletedEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $rideId;
    public $clientId;
    public $actualFare;
    public $distanceTravelledKm;
    public $durationMinutes;

    /**
     * Create a new event instance.
     *
     * @param string $rideId
     * @param string $clientId
     * @param float $actualFare
     * @param float $distanceTravelledKm
     * @param int $durationMinutes
     */
    public function __construct($rideId, $clientId, $actualFare, $distanceTravelledKm, $durationMinutes)
    {
        $this->rideId = $rideId;
        $this->clientId = $clientId;
        $this->actualFare = $actualFare;
        $this->distanceTravelledKm = $distanceTravelledKm;
        $this->durationMinutes = $durationMinutes;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('client.' . $this->clientId),
        ];
    }

    /**
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastWith()
    {
        return [
            'ride_id' => $this->rideId,
            'actual_fare' => $this->actualFare,
            'distance_travelled_km' => $this->distanceTravelledKm,
            'duration_minutes' => $this->durationMinutes,
        ];
    }
}