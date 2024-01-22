<?php

namespace Future\Messages\Livewire\Admin\Messages;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
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

        ];
    }

    public function render()
    {
        $conversations = $this->getConversation();
        return view('future::livewire.admin.messages.icon',compact('conversations'));
    }

    //viết hàm lấy ra Conversation của user hiện tại phân trang
    protected function getConversation()
    {
        $user = User::find($this->userId);
        $conversation = $user->conversations()->with(['users' => function ($query) use ($user) {
            $query->where('id', '!=', $user->id);
        },'lastMessage' => function ($query) {
            $query->latest('updated_at');
        }])->limit(10)->get();
        return $conversation;
    }
}
