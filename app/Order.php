<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Order extends Model
{

    protected $guarded = [];

    public function items()
    {
        return $this->belongsToMany(Product::class, 'order_items', 'order_id', 'product_id')->withPivot('quantity', 'price', 'variation_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function rider(){
        return $this->belongsTo(deliveryStaffModel::class, 'rider_id');
    }

    public function getShippingFullAddressAttribute()
    {

        return  $this->shipping_fullname."<br>".$this->shipping_address . ', ' . $this->shipping_city . ', ' . $this->shipping_state . ', ' . $this->shipping_zipcode . "<br> phone: " . $this->shipping_phone;
    }

    public function suborder_ent()
    {
        return $this->belongsTo(SubOrder::class, 'id', 'order_id');
    }

    public function subOrders()
    {
        return $this->hasMany(SubOrder::class);
    }

    public function generateSubOrders()
    {
        $orderItems = $this->items;
        $user_id = Auth::check() ? Auth::user()->id : null;

        foreach ( $orderItems->groupBy( 'shop_id' ) as $shopId => $products ) {
            $shop = Shop::find($shopId);

            // $suborder = $this->subOrders()->create([
            //     'order_id'=> $this->id,
            //     'seller_id'=> $shop->user_id ?? 1,
            //     'grand_total'=> $products->sum('pivot.price'),
            //     'item_count'=> $products->count()
            // ]);
            $is_pick_up_tmp = ( $this->is_pick_up == NULL ) ? "yes" : $this->is_pick_up;
            $suborder = $this->subOrders()->create([
                'order_id'=> $this->id,
                'seller_id'=> $shop->user_id ?? 1,
                'grand_total'=> $products->sum('pivot.price'),
                'item_count'=> $products->count(),
                'is_pick_up' => ($is_pick_up_tmp == 'yes') ? 'yes' : 'no',
                'status_id' =>  ($is_pick_up_tmp == 'yes') ? '8' : '1',
                'pick_up_status_id' =>  ($is_pick_up_tmp == 'yes') ? '1' : '4'
            ]);

            foreach ( $products as $product ) {
                $data = array(
                    'price' => $product->pivot->price,
                    'quantity' => $product->pivot->quantity,
                    'variation_id' => $product->pivot->variation_id
                );
                $suborder->items()->attach( $product->id, $data );
            }

            $subOrderItems = SubOrderItem::where( 'sub_order_id', $suborder->id )->get();
            \Log::info( json_encode( [ "COUNT" . $subOrderItems->count(), "ID -- " . $suborder->id ] ) );
            
            if ( $subOrderItems->count() > 0 ) {
                foreach ( $subOrderItems as $key => $subOrderItem ) {
                    $log = new ProductMonitoringLogs;
                    $log->sub_order_item_id = $subOrderItem->id;
                    $log->status = "Item pending";
                    $log->user_id = $user_id;
                    $log->images = "//";
                    $log->save();
                }
            }
        }

    }
    
}
