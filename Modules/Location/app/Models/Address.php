<?php

namespace Modules\Location\app\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = ['id_city', 'id_district', 'id_street', 'note', 'user_id'];

    public function city()
    {
        return $this->belongsTo(City::class, 'id_city');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'id_district');
    }

    public function street()
    {
        return $this->belongsTo(Street::class, 'id_street');
    }

    // Assuming you have a User model and user_id is the foreign key
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
