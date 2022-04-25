<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductCategory extends Model
{
    use SoftDeletes;
    
    protected $table = "product_categories";
    
    public function category(){
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
