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
        Schema::create('product_mixes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_id')->comment('產品ID');
            $table->bigInteger('product_mix1')->nullable()->comment('產品ID 2');
            $table->bigInteger('product_mix2')->nullable()->comment('產品ID 2');
            $table->longText('description')->nullable()->comment('產品描述');
            $table->integer('price')->comment('產品金額');
            $table->integer('quantity')->default(1)->comment('產品數量');
            $table->integer('sort')->default(1)->comment('排序');
            $table->integer('status')->default(1)->comment('狀態 1:啟用 2:停用');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_mixes');
    }
};
