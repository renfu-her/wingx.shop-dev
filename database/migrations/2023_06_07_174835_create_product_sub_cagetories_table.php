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
        Schema::create('product_sub_cagetories', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_id')->comment('產品ID');
            $table->bigInteger('product_id_sub2')->comment('產品ID 2');
            $table->bigInteger('product_id_sub3')->comment('產品ID 2');
            $table->integer('status')->default(1)->comment('狀態 1:啟用 2:停用');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_sub_cagetories');
    }
};
