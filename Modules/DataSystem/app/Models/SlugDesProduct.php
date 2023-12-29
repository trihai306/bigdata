<?php

namespace Modules\DataSystem\app\Models;

use Illuminate\Database\Eloquent\Model;

class SlugDesProduct extends Model
{
    protected $fillable = ['id_slug', 'id_product', 'value'];

    public function slugCategory()
    {
        return $this->belongsTo(SlugCategory::class, 'id_slug');
    }

    public function suggestProduct()
    {
        return $this->belongsTo(SuggestProduct::class, 'id_product');
    }
}
