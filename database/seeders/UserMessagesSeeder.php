<?php

namespace Database\Seeders;
use App\Models\User;
use Future\Messages\Http\Models\Conversation;
use Future\Messages\Http\Models\Message;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class UserMessagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Tạo 100 người dùng
        for ($i = 0; $i < 100; $i++) {
            $user = User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => bcrypt('password'), // password
                'remember_token' => \Illuminate\Support\Str::random(10),
            ]);

            // Tạo cuộc trò chuyện giữa người dùng này và người dùng có id = 1
            $conversation = Conversation::create([
                'type' => 'private',
                'name' => null,
            ]);

            // Thêm người dùng này và người dùng có id = 1 vào cuộc trò chuyện
            DB::table('user_conversations')->insert([
                ['user_id' => 1, 'conversation_id' => $conversation->id],
                ['user_id' => $user->id, 'conversation_id' => $conversation->id],
            ]);

            // Tạo 10 tin nhắn giữa hai người dùng
            for ($j = 0; $j < 10; $j++) {
                Message::create([
                    'conversation_id' => $conversation->id,
                    'sender_id' => $j % 2 == 0 ? 1 : $user->id,
                    'content' => $faker->sentence,
                    'type' => 'text',
                ]);
                //thêm unread message theo message_id
                DB::table('user_conversations')->where('user_id', $user->id)->update(['last_seen_message_id' => $j + 1]);
            }


        }
    }
}
