<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = 'order_items';

    public function product()
    {
        return $this->belongsTo(Product::class)->withTrashed();
    }

    public function productCategory(){
        return $this->belongsTo(ProductCategory::class, 'product_id');
    }

    public function product_variation(){
        return $this->belongsTo(ProductVariation::class, 'variation_id', 'id');
    }
    
}
