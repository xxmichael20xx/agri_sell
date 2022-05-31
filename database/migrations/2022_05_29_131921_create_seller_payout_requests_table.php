<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellerPayoutRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seller_payout_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId( 'user_id' )->constrained( 'users' )->onDelete( 'cascade' );
            $table->string( 'gcash_name' );
            $table->string( 'gcash_number' );
            $table->string( 'gcash_ref' )->unique();
            $table->float( 'amount' );
            $table->string( 'reject_reason' )->nullable();
            $table->boolean( 'status' )->default( 0 )->nullable();
            $table->json( 'metadata' )->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seller_payout_requests');
    }
}
