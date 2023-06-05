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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id')->comment('訂單ID');
            $table->unsignedBigInteger('product_id')->comment('產品ID');
            $table->string('name')->comment('產品名稱');
            $table->string('price')->comment('產品價格');
            $table->string('qty')->comment('產品數量');
            $table->string('subtotal')->comment('產品小計');
            $table->string('remark')->nullable()->comment('備註');
            $table->integer('status')->default(1)->comment('狀態');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
