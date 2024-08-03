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
        Schema::table('party_a_infos', function (Blueprint $table) {
            $table->unsignedBigInteger('district_id')->nullable();
            $table->unsignedBigInteger('province_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('party_a_info', function (Blueprint $table) {
            $table->dropColumn(['district_id', 'province_id']);
        });
    }
};
