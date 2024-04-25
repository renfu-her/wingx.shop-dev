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
        Schema::create('logistics_statuses', function (Blueprint $table) {
            $table->id();
            $table->integer('code')->nullable()->comment('物流狀態');
            $table->string('message')->nullable()->comment('物流狀態名稱');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logistics_statuses');
    }
};
