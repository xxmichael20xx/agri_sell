<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubOrderItem extends Model
{
    function product(){
        return $this->belongsTo(Product::class, 'product_id', 'id') ?? 'not available';
    }
    
    function sub_order_parent(){
        return $this->belongsTo(SubOrder::class, 'sub_order_id', 'id') ?? 'not available';
    }

    

    
}
