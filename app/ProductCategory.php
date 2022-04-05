<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $table = "product_categories";
    
    public function category(){
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
