<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Modules\DataSystem\app\Models\Importer;
use Modules\Location\app\Models\Address;

class ImporterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 50; $i++) {
            Importer::create([
                'name' => 'Importer ' . $i,
                'address_id' => Address::all()->random()->id,
                'code' => 'Code ' . $i,
                'phone_number' => 'Phone ' . $i,
            ]);
        }
    }
}
