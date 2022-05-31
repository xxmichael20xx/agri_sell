<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellerPayout extends Model
{
    use HasFactory;

    public function seller() {
        return $this->belongsTo( User::class, 'user_id', 'id' );
    }

    public function requests() {
        return $this->belongsTo( SellerPayoutRequest::class, 'payout_request_id ', 'id' );
    }
}
