<?php

namespace Modules\Field\database\seeders;

use Illuminate\Database\Seeder;
use Modules\Field\app\Models\Field;

class FieldSeeder extends Seeder
{
    public function run()
    {
        Field::factory()
            ->count(2)
            ->create();
    }
}
