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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_no')->comment('訂單編號');
            $table->unsignedBigInteger('member_id')->comment('會員ID');
            $table->unsignedBigInteger('coupon_id')->nullable()->comment('優惠券ID');
            $table->unsignedBigInteger('shipping_id')->comment('運送方式ID');
            $table->unsignedBigInteger('payment_id')->comment('付款方式ID');
            $table->string('name')->comment('收件人姓名');
            $table->string('mobile')->comment('收件人電話');
            $table->string('email')->comment('收件人信箱');
            $table->string('address')->comment('收件人地址');
            $table->string('discount')->comment('折扣');
            $table->string('total')->comment('總金額');
            $table->string('remark')->nullable()->comment('備註');
            $table->string('invoice')->nullable()->comment('發票');
            $table->string('invoice_title')->nullable()->comment('發票抬頭');
            $table->string('invoice_tax_id')->nullable()->comment('發票統編');
            $table->string('shipping_no')->nullable()->comment('物流單號');
            $table->string('shipping_remark')->nullable()->comment('物流備註');
            $table->string('shipping_status')->nullable()->comment('物流狀態');
            $table->date('shipping_date')->nullable()->comment('物流日期');
            $table->string('shipping_time')->nullable()->comment('物流時間');
            $table->string('shipping_fee')->nullable()->comment('物流費用');
            $table->string('shipping_discount')->nullable()->comment('物流折扣');
            $table->integer('status')->default(1)->comment('訂單狀態');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
