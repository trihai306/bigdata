<?php

namespace Modules\Location\app\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = ['name'];

    public function districts()
    {
        return $this->hasMany(District::class, 'id_city');
    }
}
