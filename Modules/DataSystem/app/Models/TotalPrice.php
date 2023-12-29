<?php

namespace Modules\DataSystem\app\Models;

use Illuminate\Database\Eloquent\Model;

class TotalPrice extends Model
{
    protected $fillable = ['value', 'unit', 'data_system_id'];

    // Assuming you have a DataSystem model
    public function dataSystem()
    {
        return $this->belongsTo(DataSystem::class);
    }
}
