<?php

namespace Modules\Conversation\database\factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Conversation\app\Models\Conversation;
use Modules\Conversation\app\Models\Message;

class MessageFactory extends Factory
{
    protected $model = Message::class;

    public function definition()
    {
        return [
            'conversation_id' => Conversation::factory(),
            'sender_id' => User::factory(),
            'reply_to_id' => null,
            'content' => $this->faker->sentence,
            'type' => $this->faker->randomElement(['text', 'image', 'video']),
            'attachment_url' => $this->faker->url,
        ];
    }
}
