<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->phoneNumber,
            'avatar' => $this->faker->imageUrl(),
            'address' => $this->faker->address,
            'birthday' => $this->faker->date(),
            'gender' => $this->faker->randomElement(['male', 'female']),
            'password' => bcrypt('password'), // password
            'status' => $this->faker->randomElement(['active', 'inactive']),
            'field' => $this->faker->randomElement(['leather_goods', 'clothing']),
            'type' => $this->faker->randomElement(['buyer', 'seller']),
            'remember_token' => Str::random(10),
        ];
    }
}
