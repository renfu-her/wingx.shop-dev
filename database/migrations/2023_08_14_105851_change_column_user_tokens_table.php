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
        Schema::table('user_tokens', function (Blueprint $table) {
            $table->dropColumn('expires_at');
            $table->string('expired_at')->comment('User Token');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_tokens', function (Blueprint $table) {
            //
        });
    }
};
