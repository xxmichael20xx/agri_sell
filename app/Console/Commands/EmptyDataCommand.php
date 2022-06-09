<?php

namespace App\Console\Commands;

use App\UserValidId;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class EmptyDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'empty:data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Empty the table data for products, order, notification, etc.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info( 'Empty data initialization' );
        $tables = array(
            'admin_notification',
            'coins_refund_requests',
            'coins_top_up',
            'coins_transaction',
            'notification_table',
            'orders',
            'order_items',
            'pre_orders',
            'products',
            'product_categories',
            'product_images',
            'product_monitoring_logs',
            'product_pricing_additionals',
            'product_refund_request',
            'product_sizes',
            'product_variations',
            'ratings',
            'refund_reason_product',
            'refund_request_products',
            'seller_payouts',
            'seller_payout_requests',
            'sub_orders',
            'sub_order_items',
            'transactions',
        );

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        foreach ( $tables as $table ) {
            DB::table( $table )->truncate();
            $this->info( "Table: {$table}" );
        }

        $this->info( "Deleting Valid IDs except for Seller" );
        UserValidId::where( 'id', '!=', 3 )->delete();
        $this->info( "Valid IDs deleted except for Seller" );

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $this->info( 'Data has been emptied.' );
    }
}
