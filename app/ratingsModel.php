<?php

namespace App;
use Product;
class ratingsModel
{
    public static function  getAveRatingProducts($product_id){
        $product_id = 1;
        $product = Product::where('id', $product_id);
        $product_ave_rating = String($product->averageRating);
        return $product_ave_rating;

    }


    public static function getShopRating($shop_id){
        $shop_id = 1;
        
    }
}
