<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariation extends Model
{
    protected $table = "product_variations";
    public $timestamps = false;

    protected $casts = [
        'metadata' => 'array'
    ];

}
