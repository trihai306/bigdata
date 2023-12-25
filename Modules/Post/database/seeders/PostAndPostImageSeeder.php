<?php

namespace Modules\Post\database\seeders;

use Illuminate\Database\Seeder;
use Modules\Post\app\Models\Post;
use Modules\Post\app\Models\PostImage;

class PostAndPostImageSeeder extends Seeder
{
    public function run()
    {
        Post::factory()
            ->count(10)
            ->has(PostImage::factory()->count(3))
            ->create();
    }
}
