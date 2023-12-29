<?php

namespace Modules\DataSystem\app\Models;

use Illuminate\Database\Eloquent\Model;

class SuggestProduct extends Model
{
    protected $fillable = ['name', 'id_category'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'id_category');
    }

    public function slugDesProducts()
    {
        return $this->hasMany(SlugDesProduct::class, 'id_product');
    }
}
