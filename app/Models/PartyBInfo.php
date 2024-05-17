<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartyBInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'contract_id',
        'email',
        'tax_id',
        'bank_account_number',
        'bank_name',
        'business_name',
        'position',
        'address',
        'phone_number',
        'full_name',
    ];

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }
}
