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
        Schema::create('traffic_logs', function (Blueprint $table) {
            $table->id();
            $table->string('source_ip');
            $table->string('destination_ip');
            $table->string('packet_size');
            $table->string('protocol');
            $table->string('type')->nullable();
            $table->integer('rssi')->nullable();
            $table->integer('channel')->nullable();
            $table->timestamp('timestamp');
            $table->json('packet_data');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('traffic_logs');
    }
};
