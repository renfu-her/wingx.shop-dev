<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // $table->renameColumn('shipping_no', 'ship_no');
            // $table->renameColumn('shipping_remark', 'ship_remark');
            // $table->renameColumn('shipping_status', 'ship_status');
            // $table->renameColumn('shipping_date', 'ship_date');
            // $table->renameColumn('shipping_fee', 'ship_fee');
            // $table->renameColumn('shipping_discount', 'ship_discount');
            // $table->renameColumn('payment_id', 'payment');
            DB::statement("ALTER TABLE orders
            CHANGE COLUMN shipping_no ship_no DATATYPE;");
            DB::statement("ALTER TABLE orders
            CHANGE COLUMN shipping_remark ship_remark DATATYPE;");
            DB::statement("ALTER TABLE orders
            CHANGE COLUMN shipping_date ship_date DATATYPE;");
            DB::statement("ALTER TABLE orders
            CHANGE COLUMN shipping_fee ship_fee DATATYPE;");
            DB::statement("ALTER TABLE orders
            CHANGE COLUMN shipping_discount ship_discount DATATYPE;");
            DB::statement("ALTER TABLE orders
            CHANGE COLUMN payment_id ship_discount DATATYPE;");

            $table->dropColumn('shipping_time');
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
