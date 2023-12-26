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
        $messages = Message::all();

        for ($i = 0; $i < $users->count(); $i += 2) {
            if (isset($users[$i+1])) {
                $conversation = Conversation::create([
                    'type' => 'private',
                    'name' => 'Private Conversation between ' . $users[$i]->name . ' and ' . $users[$i+1]->name,
                ]);

                UserConversation::create([
                    'user_id' => $users[$i]->id,
                    'conversation_id' => $conversation->id,
                    'date_joined' => now(),
//                    'last_seen_message_id' => $messages->random()->id,
                ]);

                UserConversation::create([
                    'user_id' => $users[$i+1]->id,
                    'conversation_id' => $conversation->id,
                    'date_joined' => now(),
//                    'last_seen_message_id' => $messages->random()->id,
                ]);
            }
        }
    }
}
