<?php

namespace App\Http\Livewire;
use Cart;
use Livewire\Component;
use App\ProductVariation;

class CartUpdateForm extends Component
{

    public $item = [];

    public $quantity = 0;

    public function mount($item)
    {
        $this->item = $item;

        $this->quantity = $item['quantity'];
    }


    public function updateCart()
    {
        $variation_entity = ProductVariation::where('id', $this->item['variation_id'])->first();
        if($variation_entity->is_variation_wholesale == 'yes'){
            if($this->quantity > $variation_entity->variation_min_qty_wholesale){
                \Cart::session(auth()->id())->update($this->item['id'], [
                    'quantity' => [
                        'relative' => false,
                        'value' => $this->quantity,
                    ],
                    'price' => $variation_entity->variation_wholesale_price_per
                ]);
            }else{
                \Cart::session(auth()->id())->update($this->item['id'], [
                    'quantity' => [
                        'relative' => false,
                        'value' => $this->quantity,
                    ],
                    'price' => $variation_entity->variation_price_per
                    
                ]);
            }
        }else{
            \Cart::session(auth()->id())->update($this->item['id'], [
                'quantity' => [
                    'relative' => false,
                    'value' => $this->quantity,
                ],
                'price' => $variation_entity->variation_price_per
                
            ]);
        }
        
      

        $this->emit('cartUpdated');
    }

    public function render()
    {

                        app('debugbar')->error('renderer');

        return view('livewire.cart-update-form');
    }
}
