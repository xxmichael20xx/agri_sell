<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Product;
class OrdersProductRatings extends Component
{

    public $product_rate;
    public $prid;
    public function mount($prid)
    {
        $this->product_rate = Product::where('id', $prid)->first();
        $this->prid = $prid;
    }
    public function render()
    {
        return view('livewire.orders-product-ratings');
    }
    public function addRating($rating_number, $product_id){
        $product = Product::where('id', $product_id)->first();
        $product->rateOnce($rating_number);
        $this->mount($this->prid);
    }
}
