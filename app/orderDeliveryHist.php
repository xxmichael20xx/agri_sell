<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orderDeliveryHist extends Model
{
    protected $table = 'orderstatushist';

    public function status()
    {
        return $this->belongsTo(orderDeliveryStatusModel::class);
    }

    public function order()
    {
        return $this->belongsTo(SubOrder::class);
    }
}
