<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Modules\DataSystem\app\Models\DataSystem;
use Modules\DataSystem\app\Models\DescriptionProduct;

class DescriptionProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 50; $i++) {
            DescriptionProduct::create([
                'name' => 'Product ' . $i,
                'category_id' => rand(1, 10),
                'data_system_id' => DataSystem::all()->random()->id,
            ]);
        }
    }
}
