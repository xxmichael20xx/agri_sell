<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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

        foreach($orderItems->groupBy('shop_id') as $shopId => $products) {

            $shop = Shop::find($shopId);

            // $suborder = $this->subOrders()->create([
            //     'order_id'=> $this->id,
            //     'seller_id'=> $shop->user_id ?? 1,
            //     'grand_total'=> $products->sum('pivot.price'),
            //     'item_count'=> $products->count()
            // ]);
            $is_pick_up_tmp = "";
            if($this->is_pick_up == NULL){
                $is_pick_up_tmp = "yes";
            }else{
                $is_pick_up_tmp = $this->is_pick_up;
            }

            $suborder = $this->subOrders()->create([
                'order_id'=> $this->id,
                'seller_id'=> $shop->user_id ?? 1,
                'grand_total'=> $products->sum('pivot.price'),
                'item_count'=> $products->count(),
                'is_pick_up' => ($is_pick_up_tmp == 'yes') ? 'yes' : 'no',
                'status_id' =>  ($is_pick_up_tmp == 'yes') ? '8' : '1',
                'pick_up_status_id' =>  ($is_pick_up_tmp == 'yes') ? '1' : '4'

            ]);

            foreach($products as $product) {
                $suborder->items()->attach($product->id, ['price' => $product->pivot->price, 'quantity' => $product->pivot->quantity, 'variation_id' => $product->pivot->variation_id]);
            }

        }

    }
    
}
