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
        Schema::create('invoice_lotteries', function (Blueprint $table) {
            $table->id();
            $table->string('year')->comment('年份');
            $table->string('month')->comment('月份');
            $table->string('special_bonus')->comment('特別奬');
            $table->string('special_award')->comment('特奬');
            $table->string('jackpot')->comment('頭獎');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_lotteries');
    }
};
