<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Modules\DataSystem\app\Models\CompanyTransport;
use Modules\DataSystem\app\Models\DataSystem;
use Modules\DataSystem\app\Models\Exporter;
use Modules\DataSystem\app\Models\HsCode;
use Sabberworm\CSS\Property\Import;

class DataSystemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 50; $i++) {
            DataSystem::create([
                'id' => $i + 1,
                'date' => now(),
                'import_id' => Import::all()->random()->id,
                'exporter_id' => Exporter::all()->random()->id,
                'hs_code_id' => HsCode::all()->random()->id,
                'quantity' => rand(1, 100),
                'unit' => 'kg',
                'weight' => rand(1, 100),
                'weight_unit' => 'kg',
                'package_quantity' => rand(1, 100),
                'unit_pkg' => 'box',
                'country' => 'Country ' . $i,
                'company_transport_id' => CompanyTransport::all()->random()->id,
            ]);
        }
    }
}
