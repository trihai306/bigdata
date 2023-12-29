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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_city')->constrained('cities');
            $table->foreignId('id_district')->constrained('districts');
            $table->foreignId('id_street')->constrained('streets');
            $table->text('note')->nullable();
            $table->foreignId('user_id'); // Add your own constraints for user_id as needed
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
