<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreOrderModel extends Model
{
    protected $table="pre_orders";

    public function product(){
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function customer(){
        return $this->belongsTo(User::class, 'customer_user_id', 'id');
    }

 


}
