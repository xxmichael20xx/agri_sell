<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusInRefundRequestProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('refund_request_products', function (Blueprint $table) {
            $table->boolean( 'status' )->after( 'prod_refund_status_id' )->default( 0 )->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('refund_request_products', function (Blueprint $table) {
            $table->dropColumn( 'status' );
        });
    }
}
