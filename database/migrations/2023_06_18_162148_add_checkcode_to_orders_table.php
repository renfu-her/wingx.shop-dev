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
        Schema::table('orders', function (Blueprint $table) {
            $table->string('invoice_no')->nullable()->change();
            $table->string('invoice_trans_no')->nullable()->comment('ezPay 電子發票開立序號');
            $table->string('invoice_date')->nullable()->comment('開立發票時間');
            $table->string('invoice_random_no')->nullable()->comment('隨機碼');
            $table->string('invoice_checkcode')->nullable()->comment('檢查碼');
            $table->integer('invoice_total_amt')->nullable()->comment('發票金額');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            //
        });
    }
};
