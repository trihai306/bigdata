<?php

namespace Modules\Conversation\database\seeders;

use Illuminate\Database\Seeder;
use Modules\Conversation\app\Models\Conversation;

class ConversationSeeder extends Seeder
{
    public function run()
    {
        for ($i = 0; $i < 10; $i++) {
            Conversation::create([
                'type' => 'private',
                'name' => 'Sample Conversation ' . $i,
            ]);
        }
    }
}
