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
        'id_party_b_info',
        'id_party_a_info',
        'post_id',
        'id_user_b',
        'viewed',
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
        return $this->belongsTo(PartyAInfo::class, 'id_party_a_info');
    }

    public function partyBInfo()
    {
        return $this->belongsTo(PartyBInfo::class, 'id_party_b_info');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user_b');
    }
}
