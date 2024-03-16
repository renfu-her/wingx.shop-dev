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
        Schema::create('product_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_id')->comment('產品 ID');
            $table->bigInteger('title_one_id')->nullable()->comment('title one id');
            $table->bigInteger('title_two_id')->nullable()->comment('title two id');
            $table->bigInteger('price')->nullable()->comment('金額');
            $table->bigInteger('num')->nullable()->comment('數量');  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_details');
    }
};
