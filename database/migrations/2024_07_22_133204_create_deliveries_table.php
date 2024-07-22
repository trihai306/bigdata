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
            $table->timestamp('scheduled_delivery_time')->nullable();
            $table->text('special_nature')->nullable();
            $table->string('package_image')->nullable();
            $table->decimal('length', 8, 2)->nullable();
            $table->decimal('width', 8, 2)->nullable();
            $table->decimal('height', 8, 2)->nullable();
            $table->string('delivery_service');
            $table->json('additional_services')->nullable();
            $table->text('order_note')->nullable();
            $table->string('status');
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
