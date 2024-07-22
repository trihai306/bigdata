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
            $table->enum('scheduled_delivery_time',[
                'full_day','morning','afternoon','night','sunday','holiday','time_work'
            ]);
            $table->string('contract_id');
            $table->text('special_nature');
            $table->string('package_image')->nullable();
            $table->decimal('length', 8, 2);
            $table->decimal('width', 8, 2)->nullable();
            $table->decimal('height', 8, 2)->nullable();
            $table->string('delivery_service');
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

            $table->foreign('user_delivery_info_id')->references('id')->on('user_delivery_infos')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('deliveries');
    }
}
