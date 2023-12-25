<?php

namespace Modules\Conversation\database\seeders;

use Illuminate\Database\Seeder;
use Modules\Conversation\app\Models\UserConversation;
use Modules\Conversation\app\Models\Conversation;
use App\Models\User;
use Modules\Conversation\app\Models\Message;

class UserConversationSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();
        $conversations = Conversation::all();
        $messages = Message::all();

        foreach ($conversations as $conversation) {
            foreach ($users as $user) {
                UserConversation::create([
                    'user_id' => $user->id,
                    'conversation_id' => $conversation->id,
                    'date_joined' => now(),
                    'last_seen_message_id' => $messages->random()->id,
                ]);
            }
        }
    }
}
