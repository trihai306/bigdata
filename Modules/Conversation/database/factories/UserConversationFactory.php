<?php

namespace Modules\Conversation\database\factories;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Conversation\app\Models\Conversation;
use Modules\Conversation\app\Models\Message;
use Modules\Conversation\app\Models\UserConversation;

class UserConversationFactory extends Factory
{
    protected $model = UserConversation::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'conversation_id' => Conversation::factory(),
            'date_joined' => $this->faker->dateTime,
            'last_seen_message_id' => Message::factory(),
        ];
    }
}
