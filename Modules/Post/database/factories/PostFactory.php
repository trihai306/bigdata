<?php

namespace Modules\Post\database\factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Post\app\Models\Post;
use Modules\Field\app\Models\Field;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraph,
            'field_id' => Field::factory(),
            'type' => $this->faker->randomElement(['seeking_manufacturer', 'contract_created']),
            'status' => $this->faker->randomElement(['draft', 'published', 'waiting']),
        ];
    }
}
