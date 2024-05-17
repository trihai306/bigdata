<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_image',
        'product_image',
        'description',
        'total_amount',
        'deposit_amount',
        'confirmation_a',
        'confirmation_b',
        'confirmation_c',
        'terms_agreed',
        'status',
        'estimated_delivery_date',
    ];

    const STATUS = [
        'new', 'accepted', 'picking', 'failed_to_pick', 'picked', 'shipping',
        'delivering', 'retry_delivery', 'delivered_successfully', 'pending', 'return_initiated',
        'returned', 'cancellation_requested', 'return_in_progress', 'continue_delivery',
        'shop_cancellation', 'vtp_cancellation'
    ];

    public function partyAInfo()
    {
        return $this->hasOne(PartyAInfo::class);
    }

    public function partyBInfo()
    {
        return $this->hasOne(PartyBInfo::class);
    }
}
