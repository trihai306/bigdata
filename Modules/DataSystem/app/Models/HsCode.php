<?php

namespace Modules\DataSystem\app\Models;

use Illuminate\Database\Eloquent\Model;

class HsCode extends Model
{
    protected $fillable = ['code', 'description'];

    // Assuming you have data_systems that relate to hs_code
    public function dataSystems()
    {
        return $this->hasMany(DataSystem::class, 'hs_code_id');
    }
}
