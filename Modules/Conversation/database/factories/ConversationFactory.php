<?php

namespace Modules\Conversation\database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Conversation\app\Models\Conversation;

class ConversationFactory extends Factory
{
    protected $model = Conversation::class;

    public function definition()
    {
        return [
            'type' => "private",
            'name' => $this->faker->sentence,
        ];
    }
}
