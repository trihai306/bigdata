<?php

namespace Modules\Post\database\seeders;

use Illuminate\Database\Seeder;
use Modules\Post\app\Models\Post;
use Modules\Post\app\Models\PostImage;

class PostAndPostImageSeeder extends Seeder
{
    public function run()
    {
        for ($i = 0; $i < 10; $i++) {
            $post = Post::create([
                'user_id' => 1, // giả sử user_id là 1
                'title' => 'Post ' . $i,
                'content' => 'Content for post ' . $i,
                'field_id' => 1, // giả sử field_id là 1
                'type' => 'seeking_manufacturer',
                'status' => 'published',
            ]);

            for ($j = 0; $j < 3; $j++) {
                PostImage::create([
                    'post_id' => $post->id,
                    'image' => 'https://example.com/image' . $j . '.png',
                    'user_id' => 1, // giả sử user_id là 1
                ]);
            }
        }
    }
}
