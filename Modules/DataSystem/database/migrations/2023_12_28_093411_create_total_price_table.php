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
        Schema::create('total_price', function (Blueprint $table) {
            $table->id();
            $table->decimal('value', 15, 2);
            $table->string('unit');
            $table->foreignId('data_system_id')->constrained('data_systems');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('total_price');
    }
};
