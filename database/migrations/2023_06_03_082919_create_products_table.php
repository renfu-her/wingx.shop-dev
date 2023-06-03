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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('商品名称');
            $table->string('category_id')->nullable(0)->comment('類別ID');
            // 價格直接匯入上面的價格 / 10000
            $table->decimal('price', 10, 2)->comment('商品价格');
            $table->integer('price_min')->comment('商品最低價');
            $table->integer('price_max')->comment('商品最高價');
            $table->string('image')->nullable()->comment('商品列表图片');
            $table->text('description')->nullable()->comment('商品詳細資料');
            $table->integer('status')->default(1)->comment('0: 下架 1: 上架');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
