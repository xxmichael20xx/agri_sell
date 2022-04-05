<?php

namespace App;
use DateTime;

class PreSaleAdapter 
{
    public static function getActivePreSaleCount( $pre_sale_products){
        $pre_sale_products_count = 0;
        foreach($pre_sale_products as $pre_sale_product){
            $date = new DateTime($pre_sale_product->pre_sale_deadline);
            $finned = $date->format('Y/m/d H:i A');
            $date_now = new DateTime();
            $date_now_formatted = $date_now->format('Y/m/d H:i: A');
            if(strtotime($finned) > strtotime('now')){
                $pre_sale_products_count++;
            }
        }

        return $pre_sale_products_count;
    }
}
