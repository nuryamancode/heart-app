<?php  

namespace App\Events;

use App\Models\Chat;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ChatSen implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $message;
    public $sender_id;
    public $receiver_id;
    /**
     * Create a new event instance.
     */
    public function __construct(Chat $message, $receiver_id, $sender_id)
    {
        // Log to check if event is being constructed
        Log::info('ChatSen event created' . $message);
        $this->message = $message;
        $this->sender_id = $sender_id;
        $this->receiver_id = $receiver_id;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel
     */
    public function broadcastOn(): Channel
    {
        Log::info('Broadcasting on channel: chat'); // Log channel
        return new Channel('chat.' . $this->receiver_id);
    }

    public function broadcastAs()
    {
        Log::info('Broadcasting event as: chat-event'); // Log event name
        return 'chat-event';
    }

    /**
     * The data to broadcast with the event.
     *
     * @return array
     */
    public function broadcastWith()
    {
        Log::info('Broadcast data: test'); // Log broadcast data
        return [
            'message' => $this->message->message,
            'sender_id' => $this->sender_id,
            'receiver_id' => $this->receiver_id,
            'created_at' => $this->message->created_at->toISOString(),
        ];
    }
}
