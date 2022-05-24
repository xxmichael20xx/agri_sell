<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;
use App\Order;
use App\seller_reg_fee;
use App\SubOrder;
class Shop extends Model
{
    protected $fillable=['name','description'];

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'shop_id')->withTrashed();
    }

   
}
