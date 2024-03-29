<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use Auth;
use App\Product;
use App\SubOrder;
use App\orderDeliveryStatusModel;
use App\orderpickupStatusModel;
use App\refundModelOrder;
use App\SellerPayout;
use App\SellerPayoutRequest;

class SellerPanelController extends Controller
{
    function index() {
        if ( ! Auth::user()->shop ) {
            $data = [
                'layout' => 'sellerPanel.front',
                'backUrl' => '/',
                'panel_name' => 'Panel Errors',
                'title' => '<h2>
                    Panel content failed to load.<br>
                    Please try again later.
                </h2>',
                'view' => 'info'
            ];
            return $this->showWebPages( $data );
        }

        $shop_title = Auth::user()->shop->name;
        $shop_description = Auth::user()->shop->description;
        $shop_orders = SubOrder::where('seller_id', auth()->id())->get();
        $shopProducts = Product::where('shop_id', Auth::user()->shop->id)->get();
        $shop_order_count = $shop_orders->count();
        $shopProductsCount = $shopProducts->count();

        $sumAverageRating = 0;
        $ratings_ocurr = 0;

        foreach( $shopProducts as $shopProduct ) {
            $_[] = $shopProduct->product_ratings_avg;
            $sumAverageRating += $shopProduct->product_ratings_avg;
            if ( $shopProduct->product_ratings_avg ){
                $ratings_ocurr++;     
            }
        }

        $shopAveRating = 'Unrated';
        if ( $ratings_ocurr && $sumAverageRating ) {
            $shopAveRating = round( $sumAverageRating / $ratings_ocurr, 1 );
        }
        
        $total_sales = 0;
        $order_items = $shop_orders;
        
        foreach ( $order_items as $order_item ) {
            $mainOrder = Order::find( $order_item->order_id );

            if ( ! $mainOrder ) continue;
            if ( $mainOrder->payment_method !== 'agrisell_coins' ) continue;
            if ( $order_item->status == 'completed' && $order_item->payout_request && count( $order_item->items ) > 0 ) {
                foreach( $order_item->items as $item ) {
                    $item_pivot = $item->pivot;
                    $total_sales += $item_pivot->price * $item_pivot->quantity;
                }
            }
        }

        $payouts = SellerPayoutRequest::where( 'user_id', auth()->user()->id )->get();
        $_refunds = refundModelOrder::where( 'status', 3 )->get();
        $payoutTotal = 0;
        $refundsAmount = 0;

        foreach( $_refunds as $refund ) {
            if ( $refund->product->product_user_id == auth()->user()->id ) {
                $amount = ( $refund->order_item->price * $refund->order_item->quantity / 2 );
                $refundsAmount += $amount;
            }
        }

        if ( $payouts->count() > 0 ) {
            foreach( $payouts as $payout_index => $payout ) {
                if ( $payout->status == '1' ) {
                    $payoutTotal += $payout->amount;
                    
                    if ( $payout->metadata && $payout->metadata['type'] == 'Remit' ) {
                        $remitt_amount = isset( $payout->metadata['remitt_amount'] ) ? $payout->metadata['remitt_amount'] : 0;
                        $payoutTotal += intval( $remitt_amount );
                    }
                }

            }
        }

        if ( isset( $_GET['dev'] ) ) {
            dd( $total_sales, $payoutTotal, $refundsAmount );
        }

        $total_sales_deduction_diff = $total_sales - $payoutTotal - $refundsAmount;
        if ( $total_sales_deduction_diff < 1 ) $total_sales_deduction_diff = 0;
        
        // shop_title
        // shop_description
        // shop_order_count
        // shopAveRating
        // total_sales_deduction_diff
        return view('sellerPanel.dashboard')->with(compact(
            'shop_title', 
            'shopProductsCount',
            'shop_description', 
            'shop_order_count', 
            'shopAveRating', 
            'total_sales_deduction_diff'
        ))->with('panel_name', 'dashboard');
    }


    function order_index(){
        $orders = SubOrder::where('seller_id', Auth::user()->id)->get();
        $assign_order_status_options = orderDeliveryStatusModel::all();
        return view('sellerPanel.orders.index')->with(compact('orders', 'assign_order_status_options'))->with('panel_name', 'orders');
    }

    function show_by_cat( $category_type, $status_id ) {
        $is_pick_up = ( $category_type == 'pickup' ) ? 'yes' : 'no';
        $_temp = SubOrder::where( 'seller_id', Auth::user()->id )->where( 'is_pick_up', $is_pick_up );
        $_col = "status_id";
        $assign_order_status_options = orderDeliveryStatusModel::all();
        $status_obj = orderDeliveryStatusModel::find( $status_id );

        if ( $is_pick_up == 'yes' ) {
            $_col = "pick_up_status_id";
            $status_obj = orderpickupStatusModel::find($status_id);
        }

        $orders = $_temp->where( $_col, $status_id )->latest()->get();
        foreach ( $orders as $index => $value ) {
            if ( ! $value->order ) {
                $orders->forget( $index );
            }
        }

        $pendingPickup = SubOrder::where( 'seller_id', auth()->user()->id )->where( 'is_pick_up', 'yes' )->where( 'pick_up_status_id', 1 )->get()->count();
        $pendingDelivery = SubOrder::where( 'seller_id', auth()->user()->id )->where( 'is_pick_up', 'no' )->where( 'status_id', 1 )->get()->count();

        return view( 'sellerPanel.orders.index' )
            ->with( compact( 'orders', 'assign_order_status_options', 'is_pick_up', 'status_obj', 'category_type', 'status_id', 'pendingPickup', 'pendingDelivery' ) )
            ->with( 'panel_name', 'orders' );
    }

    function product_index(){
        $products = Product::all();
        return view('sellerPanel.products.index')->with('panel_name', 'products')->with(compact('products'));
    }

    function pre_order_index(){
        
    }
}
