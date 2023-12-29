<?php

namespace Modules\DataSystem\app\Models;

use Illuminate\Database\Eloquent\Model;

class DescriptionProduct extends Model
{
    protected $fillable = ['name', 'category_id', 'data_system_id'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    // Assuming you have a DataSystem model
    public function dataSystem()
    {
        return $this->belongsTo(DataSystem::class);
    }
}
