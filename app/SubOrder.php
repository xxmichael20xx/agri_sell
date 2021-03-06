<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class SubOrder extends Model
{
    protected $guarded = [];

    protected $appends = [
        'has_items'
    ];

    public function items()
    {
        return $this->belongsToMany(Product::class, 'sub_order_items', 'sub_order_id', 'product_id')->withPivot('quantity', 'price')->withTrashed();
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

    public function scopeUserOrder( $query, $param1, $param2 ) {
        $query->where( $param1[0], $param1[1] );
        $query->where( $param2[0], $param2[1] );
        $query->whereHas( 'order', function( $q ) {
            $user_id = Auth::user()->id;
            $q->where( 'user_id', $user_id );
        } );
        return $query;
    }

    public function getHasItemsAttribute() {
        $items = SubOrderItem::where( 'sub_order_id', $this->order_id )->get()->count();
        return ( $items > 0 ) ? true : false;
    }
}
