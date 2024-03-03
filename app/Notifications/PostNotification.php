<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class PostNotification extends Notification
{
    use Queueable;

    public $type;
    public $content;
    public $title;
    public $id_post;
    public function __construct($type, $content, $title,$id)
    {
        $this->type = $type;
        $this->content = $content;
        $this->title = $title;
        $this->id_post = $id;
    }

    public function via($notifiable)
    {
        return ['database']; // Chọn kênh thông báo, ở đây là 'database'
    }

    public function toArray($notifiable)
    {
        return [
            'type' => $this->type,
            'content' => $this->content,
            'title' => $this->title,
            'id_post'=>$this->id
        ];
    }
}
