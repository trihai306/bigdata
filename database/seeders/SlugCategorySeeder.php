<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Modules\DataSystem\app\Models\SlugCategory;

class SlugCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 50; $i++) {
            SlugCategory::create([
                'name' => 'Slug Category ' . $i,
                'category_id' => rand(1, 10),
            ]);
        }
    }
}
