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
        Schema::create('product_title_twos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_id')->comment('產品 ID');
            $table->bigInteger('title_one_id')->nullable()->comment('title 1 id');
            $table->string('name')->nullable()->comment('title 2 name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_main_title_twos');
    }
};
