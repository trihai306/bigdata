<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Conversation\database\seeders\ConversationSeeder;
use Modules\Conversation\database\seeders\MessageSeeder;
use Modules\Conversation\database\seeders\UserConversationSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            PostAndPostImageSeeder::class,
        ]);
    }
}
