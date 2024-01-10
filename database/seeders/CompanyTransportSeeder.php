<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Modules\DataSystem\app\Models\CompanyTransport;

class CompanyTransportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 50; $i++) {
            CompanyTransport::create([
                'name' => 'Company ' . $i,
                'code_of_loading_port' => rand(1000, 9999),
                'import_port_code' => rand(1000, 9999),
                'invoice_number' => rand(1000, 9999),
            ]);
        }
    }
}
