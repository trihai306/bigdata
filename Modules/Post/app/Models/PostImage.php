<?php

namespace Modules\Post\app\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Post\Database\factories\PostImageFactory;

class PostImage extends Model
{
    use HasFactory;
    protected $fillable = [
        'post_id',
        'image',
        'user_id',
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
