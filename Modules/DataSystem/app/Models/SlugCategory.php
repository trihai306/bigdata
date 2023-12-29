<?php

namespace Modules\DataSystem\app\Models;


use Illuminate\Database\Eloquent\Model;

class SlugCategory extends Model
{
    protected $fillable = ['name', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function slugDesProducts()
    {
        return $this->hasMany(SlugDesProduct::class, 'id_slug');
    }
}
