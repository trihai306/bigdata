<?php
namespace App\Events;

use App\Models\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UserMessageEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $userId;
    public $sender;

    public function __construct($message, $sender, $userId)
    {
        $this->message = $message;
        $this->userId = $userId;
        $this->sender = User::find($sender);
    }

    public function broadcastOn()
    {
        return new PrivateChannel('App.Models.User.' . $this->userId);
    }

    public function broadcastWith()
    {
        $message = [
            'id' => $this->message['id'],
            'conversation_id' => $this->message['conversation_id'],
            'sender_id' => $this->message['sender_id'],
            'content' => $this->message['content'],
            'type' => $this->message['type'],
            'created_at' => $this->message['created_at']->diffForHumans(),
            'sender' => $this->sender,
        ];
        return ['message' => $message, 'sender' => $this->sender];
    }
}
