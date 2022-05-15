<?php

namespace App\Http\Controllers;

use App\Order;
use App\User;
use Illuminate\Http\Request;
use App\coinsTransaction;
use App\Events\OrderEvent;
use App\notification;
use App\Product;
use App\PreOrderModel;
use App\ProductMonitoringLogs;
use App\TransHistModel;
use Auth;
use App\SubOrder;
use App\ProductVariation;
use App\SubOrderItem;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function storefromPreOrder(Request $request)
    {
        $pre_order_inst_tmp = PreOrderModel::where('id', $request->pre_order_id)->first();
        $customer_tmp = User::where('id', $pre_order_inst_tmp->customer_user_id)->first();
        $product_tmp = Product::where('id', $pre_order_inst_tmp->product_id)->first();

        $order = new Order();
        $order->order_number = uniqid('AGRIREF-');
        $order->shipping_fullname = $customer_tmp->name;
        

        $order->shipping_address = $customer_tmp->address;
        $order->shipping_phone = $customer_tmp->mobile;
        $order->is_pick_up = $pre_order_inst_tmp->is_pick_up;

        $order->grand_total = $pre_order_inst_tmp->grand_total;
        $order->shipping_fee = $pre_order_inst_tmp->shipping_fee;
        $order->item_count = $pre_order_inst_tmp->quantity;


        $order->user_id = $customer_tmp->id;
        // agsell coins deduction
        // if (request('payment_method') == 'agrisell_coins') {
        //     $order->payment_method = 'agrisell_coins';
        //     $coins_trans = new coinsTransaction();
        //     $order->is_paid = '1';
        //     $coins_trans->user_id = $customer_tmp->id;
        //     $coins_trans->value = $order->grand_total;
        //     $coins_trans->order_reference_number = $order->order_number;
        //     $coins_trans->time_conducted = date('Y-m-d H:i:s');
        //     $coins_trans->transaction_type = 'Item orders';
        //     $coins_trans->save();
        // }
        if($order->is_pick_up == $pre_order_inst_tmp->is_pick_up){            
        }
        
        $order->save();
        
        // old code deduct product stocks
        // get product instance
        // $product = Product::where('id', $product_tmp->id)->first();
        // $order->items()->attach($product_tmp->id, ['price' => $product->price, 'quantity' => $pre_order_inst_tmp->quantity]);

        // add quantity deduction
        // update product stocks
        // deduct stocks
        // $product->stocks = $product->stocks - $product_tmp->quantity;
        // $product->save();


                //  product quantity deduction 

            $product = Product::where('id', $product_tmp->id)->first();
            $order->items()->attach($product_tmp->id, ['price' => $product->price, 'quantity' => $pre_order_inst_tmp->quantity, 'variation_id' => $pre_order_inst_tmp->variation_id]);
            $product->stocks = $product->stocks - $product_tmp->quantity;

            $product_variation_ent = ProductVariation::where('id', $pre_order_inst_tmp->variation_id)->first();
            $product_variation_ent->variation_quantity = $product_variation_ent->variation_quantity - $pre_order_inst_tmp->quantity;
            $product_variation_ent->save();
            // changelog 
        $order->generateSubOrders();

    
        // delete the preorder instance after adding to orders
        // changelog: change the preorder status to move to orders

        $pre_order_inst = PreOrderModel::find($request->pre_order_id);
        $pre_order_inst->delete();
        // $pre_order_inst->pre_order_status = 'moved_to_orders';
        // $pre_order_inst->save();
        
        return back();

    }

    public function store(Request $request)
    {
        // $request->validate([
        //     'shipping_fullname' => 'required',
        //     'shipping_state' => 'required',
        //     'shipping_city' => 'required',
        //     'shipping_address' => 'required',
        //     'shipping_phone' => 'required',
        //     'shipping_zipcode' => 'required',
        //     'payment_method' => 'required',
        // ]);

        $order = new Order();

        $order->order_number = uniqid('AGRIREF-');
        $order_ref_id = $order->order_number;
        $order->shipping_fullname = $request->input('shipping_fullname');
        $order->shipping_state = $request->input('shipping_state');
        $order->shipping_city = $request->input('shipping_city');
        $order->shipping_address = $request->input('shipping_address');
        $order->shipping_phone = $request->input('shipping_phone');
        $order->is_pick_up = ($request->input('is_pick_up') == NULL) ? 'yes' : $request->input('is_pick_up');
        $order->shipping_zipcode = $request->input('shipping_zipcode');

        if (!$request->has('billing_fullname')) {
            $order->billing_fullname = $request->input('shipping_fullname');
            $order->billing_state = $request->input('shipping_state');
            $order->billing_city = $request->input('shipping_city');
            $order->billing_address = $request->input('shipping_address');
            $order->billing_phone = $request->input('shipping_phone');
            $order->billing_zipcode = $request->input('shipping_zipcode');
        } else {
            $order->billing_fullname = $request->input('billing_fullname');
            $order->billing_state = $request->input('billing_state');
            $order->billing_city = $request->input('billing_city');
            $order->billing_address = $request->input('billing_address');
            $order->billing_phone = $request->input('billing_phone');
            $order->billing_zipcode = $request->input('billing_zipcode');
        }

        $order->grand_total = \Cart::session(auth()->id())->getTotal();
        $order->shipping_fee = \Cart::session(auth()->id())->getShippingFee();
        $order->item_count = \Cart::session(auth()->id())->getContent()->count();

        $order_ref_amount = $order->grand_total;
        $order->user_id = auth()->id();
        // agsell coins deduction
        if (request('payment_method') == 'agrisell_coins') {
            $order->payment_method = 'agrisell_coins';
            $order->is_paid = '0';
            $order->agrisell_coins_payment_status = 'pending';
            // $coins_trans = new coinsTransaction();
            // $coins_trans->user_id = $order->user_id ;
            // $coins_trans->value = $order->grand_total;
            // $coins_trans->order_reference_number = $order->order_number;
            // $coins_trans->time_conducted = date('Y-m-d H:i:s');
            // $coins_trans->transaction_type = 'Item orders';
            // $coins_trans->save();
        }
    
        $order->save();

        // Create a variable to store the seller data of each items 
        $sellerNotifs = [];
        $cartItems = \Cart::session(auth()->id())->getContent();
        // looping of cart items
        foreach ($cartItems as $item) {
            // get product instance
            $product = Product::where('id', $item->product_id)->first();
            $notifData = [
                'seller_id' => $product->product_user_id ?? NULL,
                'item_name' => $product->name,
                'item_qty' => $item->quantity,
            ];

            if ($product->is_pre_sale != '1') {
                // not pre order or presale
                $order->items()->attach($item->product_id, ['price' => $item->price, 'quantity' => $item->quantity, 'variation_id' => $item->variation_id]);
                $notifData['item_type'] = 'Order';
            } else {
                // to pre order table
                $pre_order_inst = new PreOrderModel();
                $pre_order_inst->product_id = $item->product_id;
                $pre_order_inst->pre_order_id = 'PREORDER-' . uniqid();
                $pre_order_inst->customer_user_id = Auth::id();
                $pre_order_inst->grand_total = $order_ref_amount;
                $pre_order_inst->variation_id = $item->variation_id;
                $pre_order_inst->is_pick_up =  ($request->input('is_pick_up')==NULL) ? 'yes' : $request->input('is_pick_up');

                // $pre_order_inst->is_pick_up =  ($request->input('is_pick_up')!=40) ? "pass" : "Fail";
                $pre_order_inst->pre_order_date = $product->pre_sale_deadline;
                $pre_order_inst->quantity = $item->quantity;
                
                $pre_order_inst->save();
                $notifData['item_type'] = 'Pre-Order';
            }
            // add quantity deduction
            // update product stocks
            // deduct stocks for variation
            // declare product entity
            $product_variation_ent = ProductVariation::where('product_id', $product->id)->first();
            $product_variation_ent->variation_quantity = $product_variation_ent->variation_quantity - $item->quantity;
            $product_variation_ent->save();
            // $product->stocks = $product->stocks - $item->quantity;
            // $product->save();

            $sellerNotifs[] = $notifData;
        }

        $order->generateSubOrders();
        $trans = new TransHistModel();
        $trans->user_id_master = $this->userId();
        $trans->user_id_slave = '1';
        $trans->remarks = 'User order';
        $trans->trans_type = 'Order';
        $trans->trans_ref_id = $order_ref_id;
        $trans->amount = $order_ref_amount;
        $trans->save();

        \Cart::session(auth()->id())->clear();

        if ( count( $sellerNotifs ) > 0 ) {

            // loop through all the items notification
            foreach( $sellerNotifs as $sellerNotif ) {
                $sellerId = $sellerNotif['seller_id'];
                if ( $sellerId ) {
                    $title_partial = $sellerNotif['item_type'];
                    $text_partial = strtolower( $sellerNotif['item_type'] );
                    $item_qty = number_format( $sellerNotif['item_qty'] );

                    $notification_ent = new notification();
                    $notification_ent->user_id = $sellerId;
                    $notification_ent->frm_user_id = $this->userId();
                    $notification_ent->notification_title = "New {$title_partial} - #{$order->id}";
                    $notification_ent->notification_txt = "New {$text_partial} has been placed. Item `{$sellerNotif['item_name']} x{$item_qty}`<br><br>";
                    
                    if ( $notification_ent->save() ) {
                        event( new OrderEvent( [ 'seller_id' => $sellerId, 'type' => 'new-order' ] ) );
                    }
                }
            }

        } else {
            // notification entity for orders
            $notification_ent = new notification();
            $notification_ent->user_id = $this->userId();
            $notification_ent->frm_user_id = 1;
            $notification_ent->notification_title = 'Order ' . $order->id;
            $notification_ent->notification_txt = "<br>New order has been placed.</br>";
            $notification_ent->save();
        }

        $subOrder = SubOrder::where( 'order_id', $order->id )->first();
        if ( $subOrder ) {
            $subOrderItems = SubOrderItem::where( 'sub_order_id', $order->id )->get();

            if ( $subOrderItems->count() > 0 ) {
                foreach( $subOrderItems as $subOrderItem ) {
                    $log = new ProductMonitoringLogs;
                    $log->sub_order_item_id = $subOrderItem->id;
                    $log->status = "Item pending";
                    $log->user_id = $this->userId();
                    $log->images = "//";
                    $log->save();
                }
            }
        }

        if ( request('payment_method') == 'agrisell_coins' ) {
            return redirect('/otp_validation_payment_reg/'.$order->order_number.'');
        } else {
            return redirect()->route('home')->withMessage('Order has been placed');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Order $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Order $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Order $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Order $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
