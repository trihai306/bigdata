<?php

namespace Future\Core\Livewire\Admin\Notifications;

use Livewire\Component;
use Livewire\WithPagination;

class Lists extends Component
{
    use WithPagination;

    public $page;

   public function getListeners()
   {
       return[
           'echo-private:App.Models.User.'.auth()->id().',.UserNotification' => 'reload',
       ];
   }

    public function render()
    {
        $notifications = auth()->user()->notifications()->paginate($this->page);
        return view('future::livewire.admin.notifications.lists', compact('notifications'));
    }

    public function placeholder()
    {
        return <<<'HTML'
    <div class="d-flex justify-content-center align-items-center" style="height: 100vh; width: 100%;">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
HTML;
    }

    public function loadMore()
    {
        $this->page = $this->page + 10;
    }

    public function reload()
    {
        $this->page = 10;
    }

    public function markAsRead($notificationId)
    {
        $notification = auth()->user()->notifications()->where('id', $notificationId)->first();
        if ($notification) {
            $notification->markAsRead();
            $this->dispatch('ReadNotification');
            $this->dispatch('showToast', ['type' => 'success', 'message' => 'Đã đọc thông báo']);
            return;
        }
        $this->dispatch('showToast', ['type' => 'error', 'message' => 'Không tìm thấy thông báo']);

    }
}
