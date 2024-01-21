<?php

namespace App\Jobs;

use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;

class SeedUsersJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function handle()
    {
        $faker = Faker::create();

//        for ($i = 0; $i < 10000; $i++) {
//            User::create([
//                'name' => $this->id . $faker->unique()->name,
//                'email' => $this->id . $faker->unique()->safeEmail,
//                'phone' => $this->id . $faker->unique()->phoneNumber,
//                'avatar' => $faker->imageUrl(),
//                'address' => $faker->address,
//                'birthday' => $faker->date(),
//                'gender' => $faker->randomElement(['male', 'female']),
//                'password' => bcrypt('password'), // password
//                'status' => $faker->randomElement(['active', 'inactive']),
//                'field' => $faker->randomElement(['leather_goods', 'clothing']),
//                'type' => $faker->randomElement(['buyer', 'seller']),
//                'remember_token' => Str::random(10),
//            ]);
//        }
    }
}
