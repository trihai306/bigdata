<?php

namespace Future\Messages\Livewire\Messages;

use Livewire\Component;

class MessageIcon extends Component
{
    public $count;
    public $userId;

    public function mount()
    {
        $user = auth()->user();
        $this->count = $user->getUnreadMessages()->count();
        $this->userId = $user->id;
    }

    public function getListeners()
    {
        return [
            "echo-private:messages.{$this->userId},MessageSent" => 'refreshCount',
        ];
    }

    public function render()
    {
        $conversations = $this->getConversations();
        return view('future::livewire.messages.icon', compact('conversations'));
    }

    protected function refreshCount()
    {
        $user = auth()->user();
        $this->count = $user->getUnreadMessages()->count();
    }

    protected function getConversations()
    {
        $user = auth()->user();
        $conversations = $user->conversations()->with(['users' => function ($query) use ($user) {
            $query->where('id', '!=', $user->id);
        }, 'lastMessage' => function ($query) {
            $query->latest('created_at');
        }, 'userConversations' => function ($query) use ($user) {
            $query->where('user_id', $user->id);
        }])->get()->sortByDesc(function ($conversation) {
            return $conversation->lastMessage->created_at ?? null;
        })->take(10);
        return $conversations;
    }
}
