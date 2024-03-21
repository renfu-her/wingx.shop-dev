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
        Schema::create('order_ships', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('order_id')->comment('Order ID');
            $table->bigInteger('ship_id')->default(0)->comment('Ship ID');
            $table->bigInteger('price')->default(0)->comment('Price');
            $table->integer('status')->default(0)->comment('狀態：0：啓用 1：停用');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_ships');
    }
};
