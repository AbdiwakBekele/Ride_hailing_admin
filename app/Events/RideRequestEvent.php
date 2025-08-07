<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RideRequestEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
     

    public $rideId;
    public $pickupLocation;
    public $destination;
    public $fare;
    public $carType;
    /**
     * Create a new event instance.
     */
    public function __construct()
    {
         $this->rideId = $rideId;
        $this->pickupLocation = $pickupLocation;
        $this->destination = $destination;
        $this->fare = $fare;
        $this->carType = $carType;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('ride-requests'),
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
            'pickup_location' => $this->pickupLocation,
            'destination' => $this->destination,
            'fare' => $this->fare,
            'car_type' => $this->carType,
        ];
    }
}
