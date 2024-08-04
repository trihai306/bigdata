<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveriesTable extends Migration
{
    public function up()
    {
        Schema::create('deliveries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('weight');
            $table->string('price');
            $table->string('contract_id');
            $table->text('special_nature');
            $table->string('package_image')->nullable();
            $table->decimal('length', 8, 2);
            $table->decimal('width', 8, 2)->nullable();
            $table->decimal('height', 8, 2)->nullable();
            $table->enum('delivery_service', [
                'economical_delivery',   // Chuyển phát tiết kiệm
                'fast_ecommerce_package',    // Gói TMĐT Nhanh
                'express_ecommerce_package',  // Gói TMĐT Hỏa tốc, hẹn giờ
            ]);
            $table->json('additional_services')->nullable();
            $table->text('order_note')->nullable();
            $table->enum('status', [
                'picking_up',            // Đang lấy hàng
                'picked_up',             // Đã lấy hàng
                'in_transit',            // Đang vận chuyển
                'delivering',            // Đang giao hàng
                'awaiting_redelivery',   // Chờ phát lại
                'successfully_delivered',// Giang thành công
                'awaiting_processing',   // Chờ xử lý
                'return_approved',       // Đã duyệt hoàn
                'returned',              // Đã trả
                'delivery_cancelled',    // Đã huỷ giao
                'returning',             // Đang chuyển hoàn
                'continue_delivery',     // Phát tiếp
                'shop_cancelled_pickup', // Shop huỷ lấy
                'vtp_cancelled_pickup'   // VTP huỷ lấy
            ]);

            $table->unsignedBigInteger('user_delivery_info_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('deliveries');
    }
}
