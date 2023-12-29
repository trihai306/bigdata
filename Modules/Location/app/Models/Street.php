<?php

namespace Modules\Location\app\Models;

use Illuminate\Database\Eloquent\Model;

class Street extends Model
{
    protected $fillable = ['name', 'id_district'];

    public function district()
    {
        return $this->belongsTo(District::class, 'id_district');
    }
}
