<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPayoutRequestIdToSellerPayoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('seller_payouts', function (Blueprint $table) {
            $table->foreignId( 'payout_request_id' )->after( 'user_id' )->constrained( 'seller_payout_requests' )->onDelete( 'cascade' );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('seller_payouts', function (Blueprint $table) {
            $table->dropColumn( 'payout_request_id' );
        });
    }
}
