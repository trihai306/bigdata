<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Modules\Conversation\Models\Conversation;
use Modules\Conversation\Models\Message;
use Modules\Conversation\Models\MessageReaction;
use Modules\Conversation\Models\UserConversation;
use Modules\Post\app\Models\Comment;
use Modules\Post\app\Models\Post;
use Modules\Post\app\Models\PostImage;
use Modules\Post\app\Models\TrafficPost;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens,HasRoles;
    use HasRoles;
    protected $fillable = [
        'name', 'email', 'phone', 'avatar', 'address', 'birthday', 'gender', 'password', 'status', 'field', 'type'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $dates = ['last_login_at', 'updated_at', 'created_at','birthday'];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function trafficPosts()
    {
        return $this->hasMany(TrafficPost::class);
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

    public function postsImages()
    {
        return $this->hasMany(PostImage::class);
    }
    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function messageReactions()
    {
        return $this->hasMany(MessageReaction::class);
    }

    public function userConversations()
    {
        return $this->hasMany(UserConversation::class);
    }

    public function conversations()
    {
        return $this->belongsToMany(Conversation::class, 'user_conversations');
    }
}
