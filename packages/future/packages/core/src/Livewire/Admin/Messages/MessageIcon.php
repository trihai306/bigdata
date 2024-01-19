<?php

namespace Future\Core\Livewire\Admin\Messages;

use Livewire\Component;

class MessageIcon extends Component
{
    public $count;
    public $userId;

    public function mount()
    {
        $user = auth()->user();
        $this->userId = $user->id;
    }

    public function getListeners()
    {
        return [

        ];
    }

    public function render()
    {
        return view('future::livewire.admin.messages.icon');
    }
}
