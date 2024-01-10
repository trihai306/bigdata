<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Modules\DataSystem\app\Models\Exporter;
use Modules\Location\app\Models\Address;

class ExporterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 50; $i++) {
            Exporter::create([
                'name' => 'Exporter ' . $i,
                'address_id' => Address::all()->random()->id,
                'country' => 'Country ' . $i,
            ]);
        }
    }
}
