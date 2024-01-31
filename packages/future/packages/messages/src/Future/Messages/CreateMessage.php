<?php
namespace Future\Messages\Future\Messages;

use App\Events\UserMessageEvent;
use Future\Messages\Http\Models\Message;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class CreateMessage extends Component
{
    public $message;
    #[Locked]
    public $conversationId;

    protected $rules = [
        'message' => 'required',
    ];
    #[Locked]
    public $userId;

    public function mount($conversationId, $userId)
    {
        $this->conversationId = $conversationId;
        $this->userId = $userId;
    }

    #[On('changeConversation')]
    public function changeConversation($conversationId)
    {
        $this->conversationId = $conversationId;
        $this->message = '';
    }

    public function sendMessage()
    {
        $this->validate();
        $message = Message::create([
            'conversation_id' => $this->conversationId,
            'sender_id' => Auth::id(),
            'content' => $this->message,
            'type' => 'text',
        ]);
        $message->load('sender');
        $messageData = [
            'id' => $message->id,
            'conversation_id' => $message->conversation_id,
            'sender_id' => $message->sender_id,
            'content' => $message->content,
            'type' => $message->type,
            'created_at' => $message->created_at->diffForHumans(),
            'sender' => $message->sender,
        ];
        $this->message = '';

        event(new UserMessageEvent($messageData, Auth::id(), $this->userId));
        $this->dispatch('messageSent', ['message' => $messageData]);
    }

    public function render()
    {
        return view('future::messages.create-message');
    }
}
