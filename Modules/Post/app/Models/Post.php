<?php

namespace Modules\Post\app\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Field\app\Models\Field;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'title', 'content', 'field_id', 'type', 'status'
    ];

    protected $casts = [
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function field()
    {
        return $this->belongsTo(Field::class);
    }

    public function trafficPosts()
    {
        return $this->hasMany(TrafficPost::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->latest()->limit(2);
    }

    public function likes()
    {
        return $this->hasMany(TrafficPost::class)->where('type', 'like');
    }

    public function shares()
    {
        return $this->hasMany(TrafficPost::class)->where('type', 'share');
    }

    public function views()
    {
        return $this->hasMany(TrafficPost::class)->where('type', 'view');
    }

    public function images()
    {
        return $this->hasMany(PostImage::class);
    }

    public function listComments()
    {
        return $this->hasMany(Comment::class);
    }
}
