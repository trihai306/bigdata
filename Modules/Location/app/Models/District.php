<?php

namespace Modules\Location\app\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $fillable = ['name', 'id_city'];

    public function city()
    {
        return $this->belongsTo(City::class, 'id_city');
    }

    public function streets()
    {
        return $this->hasMany(Street::class, 'id_district');
    }
}
