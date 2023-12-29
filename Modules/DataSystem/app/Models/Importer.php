<?php

namespace Modules\DataSystem\app\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Location\app\Models\Address;

class Importer extends Model
{
    protected $fillable = ['name', 'address_id', 'code', 'phone_number'];

    public function address()
    {
        return $this->belongsTo(Address::class, 'address_id');
    }

    // Assuming you have data_systems that relate to importer
    public function dataSystems()
    {
        return $this->hasMany(DataSystem::class, 'importer_id');
    }
}
