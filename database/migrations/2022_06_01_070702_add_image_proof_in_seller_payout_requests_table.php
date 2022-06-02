<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImageProofInSellerPayoutRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('seller_payout_requests', function (Blueprint $table) {
            $table->text( 'image_proof' )->after( 'reject_reason' )->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('seller_payout_requests', function (Blueprint $table) {
            $table->dropColumn( 'image_proof' );
        });
    }
}
