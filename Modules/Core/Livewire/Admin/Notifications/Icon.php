<?php

namespace Modules\Core\Livewire\Admin\Notifications;

use Livewire\Component;

class Icon extends Component
{
    public $count;
//    protected $listeners = ['ReadNotification' => 'test'];
    public function render()
    {
        return view('core::livewire.admin.notifications.icon', ['count' => $this->getCount()]);
    }

    public function mount()
    {
        $this->count = auth()->user()->unreadNotifications->count();
    }

    public function getCount()
    {
        return $this->count > 99 ? '99+' : $this->count;
    }


}
