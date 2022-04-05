<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubOrder extends Model
{
    protected $guarded = [];

    public function items()
    {
        return $this->belongsToMany(Product::class, 'sub_order_items', 'sub_order_id', 'product_id')->withPivot('quantity', 'price');
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function pickupstatus()
    {
        return $this->belongsTo(orderpickupStatusModel::class, 'pick_up_status_id');
    }

    public function deliverystatus()
    {
        return $this->belongsTo(orderDeliveryStatusModel::class, 'status_id', 'id');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
