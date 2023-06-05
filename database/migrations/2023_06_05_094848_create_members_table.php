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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('name')->coment('會員名稱');
            $table->string('email')->unique()->comment('會員信箱');
            $table->string('password')->comment('會員密碼');
            $table->string('mobile')->comment('會員電話');
            $table->string('address')->comment('會員地址');
            $table->string('remember_token')->nullable()->comment('記住我');
            $table->timestamp('email_verified_at')->nullable()->comment('信箱驗證時間');
            $table->timestamp('mobile_verified_at')->nullable()->comment('手機驗證時間');
            $table->timestamp('last_login_at')->nullable()->comment('最後登入時間');
            $table->string('last_login_ip')->nullable()->comment('最後登入IP');
            $table->string('avatar')->nullable()->comment('會員頭像');
            $table->string('provider')->nullable()->comment('第三方登入');
            $table->string('provider_id')->nullable()->comment('第三方登入ID');
            $table->integer('status')->default(1)->comment('會員狀態');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
