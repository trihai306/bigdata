<?php

namespace Modules\Post\database\factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Post\app\Models\Post;
use Modules\Post\app\Models\PostImage;

class PostImageFactory extends Factory
{
    protected $model = PostImage::class;

    public function definition()
    {
        return [
            'post_id' => Post::factory(),
            'image' => $this->faker->imageUrl(),
            'user_id' => User::factory(),
        ];
    }
}
