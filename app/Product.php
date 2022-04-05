<?php

namespace App;

use willvincent\Rateable\Rateable;
use Illuminate\Database\Eloquent\Model;
use Laravelista\Comments\Commentable;

class Product extends Model
{
    use Rateable;
    use Commentable;

    // protected $casts=[
    //     'product_attributes'=>'array'
    // ];

    protected static function booted()
    {
        static::saving(function ($product) {
            $product->product_attributes = json_encode(request('product_attributes'));
        });
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class, 'shop_id', 'id');
    }

    public function shopModel()
    {
        return $this->belongsTo(ShopModel::class, 'shop_id', 'id');
        
    }
    public function category(){
        return $this->belongsTo(ProductCategory::class, 'id', 'product_id');
    }

    public function prod_attribute(){
        return $this->belongsTo(ProductAttribute::class, 'id', 'product_id');
    }

    public function prod_variation(){
        return $this->hasMany(ProductVariation::class, 'id', 'product_id');
    }

    
    
}
