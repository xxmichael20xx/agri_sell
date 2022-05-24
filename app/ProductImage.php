<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;

    protected $fillable = [ 'is_featured' ];

    public function product() {
        return $this->belongsTo( Product::class, 'product_id' )->withTrashed();
    }
}
