<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Modules\DataSystem\app\Models\HsCode;

class HsCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 50; $i++) {
            HsCode::create([
                'code' => 'Code ' . $i,
                'description' => 'Description ' . $i,
            ]);
        }
    }
}
