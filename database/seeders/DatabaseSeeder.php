<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
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
            ConversationSeeder::class,
            MessageSeeder::class,
            UserConversationSeeder::class,
        ]);
    }
}
