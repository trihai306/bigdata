<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class UserSeeder extends Seeder
{
    public function run()
    {
        if (User::where('email', 'admin@example.com')->count() === 0) {
            DB::table('users')->insert([
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'email_verified_at' => now(),
                'phone' => '0396130621',
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
            ]);
        }
        for ($i = 0; $i < 10000; $i++) {
            User::factory()->count(10)->create();
//            Artisan::info('Seeding operation run ' . ($i + 1) . ' times.');
        }
    }
}
