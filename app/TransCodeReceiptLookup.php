<?php

namespace App;



use phpDocumentor\Reflection\Types\Boolean;
use DB;
class TransCodeReceiptLookup
{
    public static function isUsed($transaction_code, $transid){
        // lookup for duplicate transaction code for sell registration fee and coins top up
        // list may be update for it accepts more payments
//        $is_found = false;

        $lookup_coins_top_up = DB::table('coins_top_up')->where('trans_id', '=',$transaction_code)->where('id', '!=', $transid)->first();
        if ($lookup_coins_top_up == null){
            return 'false';
        }else{
            return 'true';
        }

        $lookup_sell_reg = DB::table('seller_registration_fee')->where('$transaction_code', '=',$transaction_code)->first();
        if ($lookup_sell_reg == null){
            return 'false';
        }else{
            return 'true';
        }

    }

    public static function findInstanceTable($transaction_code){
        // lookup for duplcate transaction code if found
        $table_inst_name = '';
        $lookup_coins_top_up = DB::table('coins_top_up')->where('trans_id', '=',$transaction_code)->first();
        if ($lookup_coins_top_up == null){
        }else{
            $table_inst_name = 'Coins top up';

        }

        $lookup_sell_reg = DB::table('seller_registration_fee')->where('$transaction_code', '=',$transaction_code)->first();
        if ($lookup_sell_reg == null){
        }else{
            $table_inst_name = 'Seller registration fee';
        }

        return $table_inst_name;
    }
}
