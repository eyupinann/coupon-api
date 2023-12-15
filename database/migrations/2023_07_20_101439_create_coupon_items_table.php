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
        Schema::create('coupon_items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('coupon_id');
            $table->string('mbs')->nullable();
            $table->string('oran')->nullable();
            $table->string('ev')->nullable();
            $table->string('deplasman')->nullable();
            $table->string('tahmin')->nullable();
            $table->string('iy')->nullable();
            $table->string('ms')->nullable();
            $table->string('durum')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupon_items');
    }
};
