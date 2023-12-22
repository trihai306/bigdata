<?php

namespace Modules\Field\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Field extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'icon', 'status'
    ];

    protected $casts = [

    ];
}
