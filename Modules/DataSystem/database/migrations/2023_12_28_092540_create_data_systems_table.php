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
        Schema::create('data_systems', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->foreignId('import_id')->constrained('importers');
            $table->foreignId('exporter_id')->constrained('exporters');
            $table->unsignedBigInteger('hs_code_id'); // Adjust this according to your HS code table
            $table->integer('quantity');
            $table->string('unit');
            $table->double('weight');
            $table->string('weight_unit');
            $table->integer('package_quantity');
            $table->string('unit_pkg');
            $table->string('country');
            $table->foreignId('company_transport_id')->constrained('company_transports');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_systems');
    }
};
