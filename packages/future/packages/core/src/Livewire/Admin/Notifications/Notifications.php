<?php

namespace Future\Core\Livewire\Admin\Notifications;

use Livewire\Component;
use Livewire\WithPagination;

class Notifications extends Component
{
    public $notifications;
    public $page = 10;

    public function getListeners()
    {
        return [
           'showNotifications' => 'reload',
        ];
    }

    public function render()
    {
        $this->notifications = auth()->user()->notifications()->limit($this->page)->get();

        return view('future::livewire.admin.notifications.lists');
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

    public function reload()
    {
        $this->page = 10;
    }

    public function loadMore()
    {
        $this->page = $this->page + 10;
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

    public function readAll()
    {
        try {
            auth()->user()->unreadNotifications->markAsRead();
            $this->dispatch('ReadNotification');
            $this->dispatch('showToast', ['type' => 'success', 'message' => 'Đã đọc tất cả thông báo']);
        }
        catch (\Exception $exception) {
            $this->dispatch('showToast', ['type' => 'error', 'message' => 'Có lỗi xảy ra']);
        }
    }
}
