<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DriverAcceptsRideEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $rideId;
    public $driverId;
    public $driverName;
    public $vehicle;
    public $eta;

    /**
     * Create a new event instance.
     *
     * @param string $rideId
     * @param string $driverId
     * @param string $driverName
     * @param array $vehicle
     * @param int $eta
     */
    public function __construct($rideId, $driverId, $driverName, $vehicle, $eta)
    {
        $this->rideId = $rideId;
        $this->driverId = $driverId;
        $this->driverName = $driverName;
        $this->vehicle = $vehicle;
        $this->eta = $eta;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('ride.' . $this->rideId),
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
            'driver_id' => $this->driverId,
            'driver_name' => $this->driverName,
            'vehicle' => $this->vehicle,
            'eta' => $this->eta,
        ];
    }
}