<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddCreatedAtToSubOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sub_order_items', function (Blueprint $table) {
            $table->dateTime( 'created_at' )->default( DB::raw( 'CURRENT_TIMESTAMP' ) )->nullable();;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sub_order_items', function (Blueprint $table) {
            $table->dropColumn( 'created_at' );
        });
    }
}
