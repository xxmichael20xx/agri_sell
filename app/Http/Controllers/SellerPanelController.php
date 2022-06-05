<?php

namespace App\Http\Controllers;

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
        $shop_title = Auth::user()->shop->name;
        $shop_description = Auth::user()->shop->description;
        $shop_orders = SubOrder::where('seller_id', auth()->id())->get();
        $shopProducts = Product::where('shop_id', Auth::user()->shop->id)->get();
        $shop_order_count = $shop_orders->count();
        $shopProductsCount = $shopProducts->count();

        $sumAverageRating = 0;
        $ratings_ocurr = 0;
        $shopAveRating = 0;

        foreach ( $shopProducts as $shopProduct ) {
            if ( $shopProduct->averageRating != null || $shopProduct->averageRating() != 0 ) {
                $sumAverageRating += $shopProduct->averageRating();
                $ratings_ocurr++;
            }
        }

        if ( $ratings_ocurr != 0 && $sumAverageRating != 0 ) {
            $shopAveRating = round( $sumAverageRating / $ratings_ocurr, 1 );

        } else {
            $shopAveRating = 'Unrated';
        }
        
        $total_sales = 0;
        $order_items = $shop_orders;
        
        foreach ( $order_items as $order_item ) {
            if ( $order_item->status == 'completed' && ! $order_item->payout_request && count( $order_item->items ) > 0 ) {
                foreach( $order_item->items as $item ) {
                    $item_pivot = $item->pivot;

                    /* if ( $item->is_sale == 1 ) {
                        $itemprice = $item->price - ( ( $item->sale_pct_deduction / 100 ) * $item->price );
                    } */

                    $total_sales += $item_pivot->price * $item_pivot->quantity;
                }
            }
        }

        /* $total_commission_deduction = 10;
        $total_sales_deduction = $total_sales - ( ( $total_commission_deduction / 100 ) * $total_sales );
        $total_sales_deduction_diff = $total_sales - $total_sales_deduction; */

        $payouts = SellerPayoutRequest::where( 'user_id', auth()->user()->id )->get();

        $payoutTotal = 0;

        if ( $payouts->count() > 0 ) {
            foreach( $payouts as $payout_index => $payout ) {
                $payoutTotal += $payout->amount;
            }
        }

        $total_sales_deduction_diff = $total_sales - $payoutTotal;
        if ( $total_sales_deduction_diff < 1 ) {
            $total_sales_deduction_diff = 0;
        }
        
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
