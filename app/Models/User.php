<?php

namespace App\Models;

use Future\Messages\Http\Models\Traits\HasMessages;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens,HasRoles;
    use HasRoles;
    use HasMessages;
    protected $fillable = [
        'name', 'email', 'phone', 'avatar', 'address', 'birthday', 'gender', 'password', 'status', 'field', 'type'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $dates = ['last_login_at', 'updated_at', 'created_at','birthday'];


}
