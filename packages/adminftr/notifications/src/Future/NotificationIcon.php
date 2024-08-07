<?php

namespace Adminftr\Notifications\Future;

use Livewire\Component;

class NotificationIcon extends Component
{
    public $count;

    public $userId;

    public function mount()
    {
        $user = auth()->user();
        $this->userId = $user->id;
        $this->count = $user->unreadNotifications->count();
    }

    public function getListeners()
    {
        return [
            'ReadNotification' => 'loadCount',
            'reloadNotification' => 'loadCount',
        ];
    }

    public function render()
    {
        return view('notifications::notifications.icon', ['count' => $this->getCount()]);
    }

    public function getCount()
    {
        return $this->count > 99 ? '99+' : $this->count;
    }

    public function loadCount()
    {
        $this->count = auth()->user()->unreadNotifications->count();
    }
}
