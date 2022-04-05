<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class seller_reg_fee extends Model
{
    protected $table = 'seller_registration_fee';
    public $timestamps = false;

    public function owner(){
        return $this->belongsTo(User::class, 'user_id') ?? NULL;
    }

    public function info(){
        return $this->belongsTo(SellerRegistrationRemark::class, 'status') ?? NULL;
    }

    public function invalid_reason(){
        return $this->belongsTo(invalid_sell_reg_reasons::class, 'invalid_reason_id_status', 'id') ?? NULL;
    }

}
