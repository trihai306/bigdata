<?php

namespace Modules\DataSystem\app\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name'];

    public function suggestProducts()
    {
        return $this->hasMany(SuggestProduct::class, 'id_category');
    }

    public function slugCategories()
    {
        return $this->hasMany(SlugCategory::class);
    }

    public function descriptionProducts()
    {
        return $this->hasMany(DescriptionProduct::class);
    }
}
