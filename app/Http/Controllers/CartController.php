<?php

namespace App\Http\Controllers;
use Barryvdh\Debugbar\Facade as DebugBar;

use App\Coupon;
use App\Product;
use Cart;
use DB;
use Auth;
use App\ProductVariation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    public function add(Product $product)
    {
        $sale_pct_deduct = '-'.$product['sale_pct_deduction'] . '%';
        // identify if the item object is sale or not
           $saleCondition = new \Darryldecode\Cart\CartCondition(array(
            'name' => 'SALE 5%',
            'type' => 'tax',
            'value' => $sale_pct_deduct
        ));
           $wholeSale_discount = '-' . $product['whole_sale_pct_deduction'] . '%';

   $wholeSaleCondition = new \Darryldecode\Cart\CartCondition(array(
            'name' => 'SALE 5%',
            'type' => 'tax',
            'value' => $sale_pct_deduct
        ));

        $wholeSaleMinQty = $product['whole_sale_min_qty'];
        // add the product to cart
        \Cart::session(auth()->id())->add(array(
            'id' => $req->variation_id,
            'product_id' => $product->id,
            'name' => $product->name,
            'description'=> $product->description,
            'cover_img' => $product->cover_img,
            'price' => $product->price,
            'quantity' => 1,
            'attributes' => array(),
            'conditions' => ($product->is_sale == 1) ? $saleCondition : null,
            'isSale' => $product->is_sale,
            'isWholeSale' => ($product->is_whole_sale == 1) ? '1' : '0',
            'wholeSaleMinQty' => ($product->is_whole_sale == 1) ? $wholeSaleMinQty : 1,
            'salePct' => $product->sale_pct_deduction,
            'wholeSalePct' => $product->whole_sale_pct_deduction,
            'associatedModel' => $product,
        ));

        return redirect()->route('cart.index');

    }

    public function addWquantity(Product $product, Request $req)
    {
        $sale_pct_deduct = '-'.$product['sale_pct_deduction'] . '%';
        // identify if the item object is sale or not
           $saleCondition = new \Darryldecode\Cart\CartCondition(array(
            'name' => 'SALE 5%',
            'type' => 'tax',
            'value' => $sale_pct_deduct
        ));
           $wholeSale_discount = '-' . $product['whole_sale_pct_deduction'] . '%';

        $wholeSaleCondition = new \Darryldecode\Cart\CartCondition(array(
            'name' => 'SALE 5%',
            'type' => 'tax',
            'value' => $sale_pct_deduct
        ));


        $wholeSaleMinQty = $product['whole_sale_min_qty'];
        // add the product to cart
        // customize the price add parameter as have a variation in the second parameter
        \Cart::session(auth()->id())->add(array(
            'id' => $req->variation_id,
            'product_id' => $product->id,
            'name' => $product->name,
            'description'=> $product->description,
            'cover_img' => $product->cover_img,
            'price' => $product->price,
            'quantity' => $req->quantity,
            'attributes' => array(),
            'conditions' => ($product->is_sale == 1) ? $saleCondition : null,
            'isSale' => $product->is_sale,
            'isWholeSale' => ($product->is_whole_sale == 1) ? '1' : '0',
            'wholeSaleMinQty' => ($product->is_whole_sale == 1) ? $wholeSaleMinQty : 1,
            'salePct' => $product->sale_pct_deduction,
            'wholeSalePct' => $product->whole_sale_pct_deduction,
            'associatedModel' => $product,
        ));
        return redirect()->route('cart.index');

    }

    // default entity
    public function addWquantityVariation(Product $product, Request $req)
    {
        $sale_pct_deduct = '-'.$product['sale_pct_deduction'] . '%';
        // identify if the item object is sale or not
           $saleCondition = new \Darryldecode\Cart\CartCondition(array(
            'name' => 'SALE 5%',
            'type' => 'tax',
            'value' => $sale_pct_deduct
        ));
        // $wholeSale_discount = '-' . $product['whole_sale_pct_deduction'] . '%';

        // $wholeSaleCondition = new \Darryldecode\Cart\CartCondition(array(
        //     'name' => 'SALE',
        //     'type' => 'tax',
        //     'value' => $sale_pct_deduct
        // ));


        // delclare a product variation obj in cart
        $productVariationObj = ProductVariation::find($req->variation_id);

        $product_final_price_tmp = 0;
        if ($productVariationObj->is_variation_wholesale_only == 'yes') {
        $product_final_price_tmp = $productVariationObj->variation_wholesale_price_per;
        }else{
        $product_final_price_tmp = $productVariationObj->variation_price_per;
        }
        
        $wholeSaleMinQty = $productVariationObj->variation_min_qty_wholesale;


        // add the product to cart
        // customize the price add parameter as have a variation in the second parameter
        

        \Cart::session(auth()->id())->add(array(
            'id' => $req->variation_id,
            'product_id' => $product->id,
            'name' => $product->name,
            'description'=> $product->description,
            'cover_img' => $product->cover_img,
            'price' => $product_final_price_tmp,
            'quantity' => $req->quantity,
            'attributes' => array(),
            'conditions' => ($product->is_sale == 1) ? $saleCondition : null,
            'isSale' => $product->is_sale,
            'isWholeSale' => ($product->is_whole_sale == 1) ? '1' : '0',
            'wholeSaleMinQty' => $wholeSaleMinQty,
            'salePct' => $product->sale_pct_deduction,
            'wholeSalePct' => $product->whole_sale_pct_deduction,
            'associatedModel' => $product,
            'variation_id' => $req->variation_id,
        ));
        return redirect()->route('cart.index');

    }

    public function index()
    {

        $cartItems = \Cart::session(auth()->id())->getContent();
        // new shopping sale cod

        return view('cart.index', compact('cartItems'));
    }

    public function destroy($itemId)
    {

     \Cart::session(auth()->id())->remove($itemId);

     return back();
 }

 public function update($rowId)
 {
// you may also add multiple condition on an item

    // revisi march 13
    \Cart::session(auth()->id())->update($rowId, [
        'quantity' => [
            'relative' => false,
            'value' => request('quantity'), 
        ]
    ]);  

    return back();
}

public function checkout()
{
    $cartItems = \Cart::session(auth()->id())->getContent();

    // get agcoins value
    $total_ag_coins = 0;
    $curr_ag_coins_insts = DB::table('coins_top_up')->where('user_id', Auth::id())->where('remarks', '1')->get();
    foreach($curr_ag_coins_insts as $curr_ag_coins_obj){
        $total_ag_coins += $curr_ag_coins_obj->value;
    }

    $ag_coins_trans_insts = DB::table('coins_transaction')->where('user_id', Auth::id())->get();
    foreach($ag_coins_trans_insts as $ag_coins_trans_obj){
        $total_ag_coins -= $ag_coins_trans_obj->value;
    }
    $autofill_data = DB::table('users')->where('id', Auth::id())->first();
    return view('cart.checkout')->with('autofill_data', $autofill_data)->with('cartItems', $cartItems)->with('total_ag_coins', $total_ag_coins);
}

public function applyCoupon()
{
    $couponCode = request('coupon_code');

    $couponData = Coupon::where('code', $couponCode)->first();

    if(!$couponData) {
        return back()->withMessage('Sorry! Coupon does not exist');
    }


        //coupon logic
    $condition = new \Darryldecode\Cart\CartCondition(array(
        'name' => $couponData->name,
        'type' => $couponData->type,
        'target' => 'total',
        'value' => $couponData->value,
    ));

        Cart::session(auth()->id())->condition($condition); // for a speicifc user's cart


        return back()->withMessage('coupon applied');

    }
}
