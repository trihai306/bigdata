<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartyAInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', // Add this line
        'account_number',
        'email',
        'bank_name',
        'address',
        'recipient_name',
    ];

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
