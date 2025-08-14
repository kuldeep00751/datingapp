<?php 

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class UnseenMessagesUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $unseenCount;
    public $userId;
    
    public function __construct($userId, $unseenCount)
    {
        $this->userId = $userId;
        $this->unseenCount = $unseenCount;
    }

    public function broadcastOn()
    {
        return new Channel('UnseenMessage');
    }

    public function broadcastWith()
    {
        return [
            'unseenCount' => $this->unseenCount,  
            'userId' => $this->userId, 
        ];
    }
}
