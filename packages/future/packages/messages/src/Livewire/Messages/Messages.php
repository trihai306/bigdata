<?php

namespace Future\Messages\Livewire\Messages;

use Livewire\Component;

class Messages extends Component
{
    public $conversationId;
    public $messages = [];
    public $page = 10;
    public function mount($conversationId = null)
    {
        $this->conversationId = $conversationId;
        if ($this->conversationId) {
            if (!auth()->user()->conversations()->where('id', $this->conversationId)->exists()) {
                $this->messages = [];
            } else {
                $this->messages = $this->getMessages();
            }
        }
    }

    public function getListeners()
    {
        return [
            "echo-private:messages.{$this->conversationId},MessageSent" => 'refreshMessages',
        ];
    }

    public function getMessages()
    {
        $messagesConversation = Messages::with(['user'])->where('conversation_id', $this->conversationId);
        $messages = $messagesConversation->orderByDesc('created_at')->paginate($this->page);
        return $messages;
    }
    public function render()
    {
        return view('future::livewire.messages.list-messages');
    }
}
