<?php

namespace App\Events;

use App\Models\Chat;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendUserMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets;

    public $message;
    public $sender_id;
    public $receiver_id;

    public function __construct($message, $sender_id, $receiver_id)
    {
        $this->message = $message;
        $this->sender_id = $sender_id;
        $this->receiver_id = $receiver_id;
        Log::info('Broadcasting event', ['message' => $message, 'sender_id' => $sender_id]);
    }

    public function broadcastOn()
    {
        // Broadcast ke channel user-chat
        return new Channel('user-chat');
    }
    public function broadcastAs()
    {
        return 'SendUserMessage'; // Nama event broadcasting
    }
}


