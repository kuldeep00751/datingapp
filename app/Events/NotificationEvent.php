<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NotificationEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $unseenNotiCount;
    public $userId;

    public function __construct($userId, $unseenNotiCount)
    {
        $this->userId = $userId;
        $this->unseenNotiCount = $unseenNotiCount;
    }

    public function broadcastOn()
    {
        return new Channel('UnseenNotification');
    }

    public function broadcastWith()
    {
        return [
            'unseenNotiCount' => $this->unseenNotiCount,  
            'userId' => $this->userId, 
        ];
    }
}
