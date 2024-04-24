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
        Schema::create('cvs_store_details', function (Blueprint $table) {
            $table->id();
            $table->string('store_id')->nullable()->comment('超商代碼');
            $table->string('store_name')->nullable()->comment('超商名稱');
            $table->string('telephone')->nullable()->comment('超商電話');
            $table->string('address')->nullable()->comment('超商地址');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cvs_store_details');
    }
};
