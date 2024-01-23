<?php

namespace Future\Messages\Livewire\Messages;

use Livewire\Component;

class ListConversation extends Component
{
    public $search;
    public $page = 10;
    protected function getConversations()
    {
        $user = auth()->user();
        $conversations = $user->conversations()->with(['users' => function ($query) use ($user) {
            $query->where('id', '!=', $user->id);
        }, 'lastMessage' => function ($query) {
            $query->latest('created_at');
        }, 'userConversations' => function ($query) use ($user) {
            $query->where('user_id', $user->id);
        }])
            //thêm đoạn tìm kiếm user
            ->whereHas('users', function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->orderByDesc('created_at')->paginate($this->page);
        return $conversations;
    }

    public function loadMore()
    {
        $this->page += 10;
    }
    public function render()
    {
        $conversations = $this->getConversations();
        return view('future::livewire.messages.list-conversation', compact('conversations'));
    }
}
