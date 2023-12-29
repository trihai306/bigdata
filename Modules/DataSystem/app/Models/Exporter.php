<?php

namespace Modules\DataSystem\app\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Location\app\Models\Address;

class Exporter extends Model
{
    protected $fillable = ['name', 'address_id', 'country'];

    public function address()
    {
        return $this->belongsTo(Address::class, 'address_id');
    }

    // Assuming you have data_systems that relate to exporter
    public function dataSystems()
    {
        return $this->hasMany(DataSystem::class, 'exporter_id');
    }
}
