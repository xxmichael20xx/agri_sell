<?php

namespace App;
use DB;
use App\coinsTopUpModel;
use App\seller_reg_fee;

class TransactionCode
{
    public static function trans_code_duplicate_check_display($trans_code){
        if (coinsTopUpModel::where('trans_id', '=', $trans_code)->count() > 0 || seller_reg_fee::where('trans_id', $trans_code)->count() > 0) {
            $existence = "yes";
         }else{
             $existence = "no";
         }
        return $existence;
    }
}