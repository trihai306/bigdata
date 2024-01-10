<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Modules\DataSystem\app\Models\SlugDesProduct;

class SlugDesProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 50; $i++) {
            SlugDesProduct::create([
                'id_slug' => rand(1, 50),
                'id_product' => rand(1, 50),
                'value' => 'Value ' . $i,
            ]);
        }
    }
}
