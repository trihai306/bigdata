<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Modules\DataSystem\app\Models\TotalPrice;

class TotalPriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 50; $i++) {
            TotalPrice::create([
                'value' => rand(1000, 9999),
                'unit' => 'USD',
                'data_system_id' => $i + 1,
            ]);
        }
    }
}
