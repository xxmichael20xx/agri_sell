<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellerPayoutRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'gcash_name',
        'gcash_number',
        'amount',
        'status',
        'metadata'
    ];

    protected $casts = [
        'metadata' => 'array'
    ];

    public function seller() {
        return $this->belongsTo( User::class, 'user_id', 'id' );
    }

    public function payout() {
        return $this->hasOne( SellerPayout::class, 'payout_request_id', 'id' );
    }
}
