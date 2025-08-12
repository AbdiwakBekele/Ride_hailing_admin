<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RideAcceptedEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $routeId;
    public $driverId;
    public $driverName;
    public $vehicleDetails;
    public $driverLocation;
    public $eta;

    /**
     * Create a new event instance.
     *
     * @param int $routeId
     * @param int $driverId
     * @param string $driverName
     * @param array $vehicleDetails
     * @param array $driverLocation
     * @param int $eta
     */
    public function __construct($routeId, $driverId, $driverName, $vehicleDetails, $driverLocation, $eta)
    {
        $this->routeId = $routeId;
        $this->driverId = $driverId;
        $this->driverName = $driverName;
        $this->vehicleDetails = $vehicleDetails;
        $this->driverLocation = $driverLocation;
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
            new PrivateChannel('ride.' . $this->routeId), // Use a dynamic channel name
        ];
    }
}