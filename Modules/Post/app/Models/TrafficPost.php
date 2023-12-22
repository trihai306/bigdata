<?php

namespace Modules\Post\app\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TrafficPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id', 'ip', 'user_id', 'type', 'status'
    ];

    protected $casts = [
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
