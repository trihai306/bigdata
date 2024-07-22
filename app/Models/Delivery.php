<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;

    protected $fillable = [
        'scheduled_delivery_time', // Thời gian giao hẹn
        'special_nature', // Tính chất hàng hóa đặc biệt
        'package_image', // Ảnh gói hàng
        'length', // Chiều dài
        'width', // Chiều rộng
        'height', // Chiều cao
        'delivery_service', // Dịch vụ chuyển phát
        'additional_services', // Dịch vụ cộng thêm
        'order_note', // Ghi chú đơn hàng
        'status', // Trạng thái đơn
        'user_delivery_info_id', // Khóa ngoại
        'shipping_code', // Mã vận chuyển
        'contract_id' // Mã hợp đồng
    ];

    protected $casts = [
        'additional_services' => 'array' // Cast this to array as it may hold multiple values
    ];

    public function goods()
    {
        return $this->hasMany(Good::class); // Một đơn vị vận chuyển có thể có nhiều hàng hóa
    }

    public function userDeliveryInfo()
    {
        return $this->belongsTo(UserDeliveryInfo::class); // Thông tin giao hàng liên kết với người dùng
    }

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }
}
