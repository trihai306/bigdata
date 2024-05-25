<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contract;
use Faker\Factory as Faker;

class ContractTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 50; $i++) {
            Contract::create([
                'invoice_image' => $faker->imageUrl(),
                'product_image' => $faker->imageUrl(),
                'description' => $faker->text(),
                'total_amount' => $faker->randomFloat(2, 0, 10000),
                'deposit_amount' => $faker->randomFloat(2, 0, 5000),
                'confirmation_a' => $faker->boolean(),
                'confirmation_b' => $faker->boolean(),
                'confirmation_c' => $faker->boolean(),
                'terms_agreed' => $faker->boolean(),
                'status' => $faker->randomElement(Contract::STATUS),
                'estimated_delivery_date' => $faker->dateTimeBetween('now', '+1 year'),
            ]);
        }
    }
}
