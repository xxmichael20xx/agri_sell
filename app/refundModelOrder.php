<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Order;
use App\SubOrder;
class refundModelOrder extends Model
{
    protected $table = "refund_request_products";

    protected $appends = [
        'expl_images'
    ];

    public function customer(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function order(){
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    public function product(){
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function order_item(){
        return $this->belongsTo(OrderItem::class, 'order_item_id', 'id');
    }

    public function status(){
        return $this->belongsTo(prod_refund_statuses::class, 'prod_refund_status_id', 'id');
    }

    public function getExplImagesAttribute() {
        return explode( ",", rtrim( $this->image_proofs, "," ) );
    }

}
