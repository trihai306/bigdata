<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            ConversationSeeder::class,
            MessageSeeder::class,
            UserConversationSeeder::class,
        ]);

//        for($i = 0; $i < 1000; $i++) {
//            \App\Models\User::factory(1000)->create();
//        }

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
//        DB::table('users')->insert([
//            'name' => 'Admin',
//            'email' => 'admin@example.com',
//            'email_verified_at' => now(),
//            'password' => Hash::make('password'),
//            'remember_token' => Str::random(10),
//        ]);
    }
}
