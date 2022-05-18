<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductMonitoringLogs extends Model
{
    protected $table = 'product_monitoring_logs';

    protected $appends = [
        'item_image'
    ];

    protected $casts = [
        'metadata' => 'array'
    ];

    public function sub_order_item(){
        return $this->belongsTo(SubOrderItem::class, 'sub_order_item_id', 'id') ?? 'not available';
    }

    public function created_by_user(){
        return $this->belongsTo(User::class, 'user_id', 'id') ?? 'not available';
    }

    public function getItemImageAttribute() {
        $item = SubOrderItem::find( $this->sub_order_item_id );
        
        if ( ! $item ) return $this->images;
        return $item->product->featured_image;
    }
    
}
