<?php

namespace Modules\Conversation\database\seeders;

use Illuminate\Database\Seeder;
use Modules\Conversation\app\Models\Message;
use Modules\Conversation\app\Models\Conversation;
use App\Models\User;

class MessageSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();
        $conversations = Conversation::all();

        foreach ($conversations as $conversation) {
            foreach ($users as $user) {
                Message::create([
                    'conversation_id' => $conversation->id,
                    'sender_id' => $user->id,
                    'reply_to_id' => null,
                    'content' => 'This is a sample message',
                    'type' => 'text',
                    'attachment_url' => 'http://example.com',
                ]);
            }
        }
    }
}
