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
            $table->tinyInteger('type')->default(1)->comment('1: 二連式發票 2: 三聯式發票');
            $table->string('company_name')->comment('公司名稱');
            $table->string('company_uid')->comment('統一編號');
            $table->string('company_address')->comment('公司地址');
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
