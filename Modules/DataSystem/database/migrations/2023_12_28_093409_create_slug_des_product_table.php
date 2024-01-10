<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('slug_des_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_slug')->constrained('slug_categories');
            $table->foreignId('id_product')->constrained('suggest_products');
            $table->text('value');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('slug_des_product');
    }
};
