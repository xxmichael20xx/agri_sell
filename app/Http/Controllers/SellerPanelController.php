<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Product;
use App\Shop;
use App\Order;
use App\SubOrder;
use App\orderDeliveryStatusModel;
use App\orderpickupStatusModel;
class SellerPanelController extends Controller
{
    function index(){
        $shop_title = Auth::user()->shop->name;
        $shop_description = Auth::user()->shop->description;
        $shop_order_count = SubOrder::where('seller_id', auth()->id())->count();
        $shopProducts = Product::where('shop_id', Auth::user()->shop->id)->get();
        $shopProductsCount = Product::where('shop_id', Auth::user()->shop->id)->count();

        $sumAverageRating = 0;
        $ratings_ocurr = 0;
        foreach($shopProducts as $shopProduct){
            if($shopProduct->averageRating != null || $shopProduct->averageRating() != 0){
                $sumAverageRating += $shopProduct->averageRating();
                $ratings_ocurr++;
            }
        }
        $shopAveRating = 0;
        if($ratings_ocurr != 0 && $sumAverageRating != 0){
        $shopAveRating = round($sumAverageRating/$ratings_ocurr, 1);
        }else{
        $shopAveRating = 'Unrated';
        }
        
        $total_sales = 0;
        $order_count = SubOrder::where('seller_id', auth()->id())->count();
        $order_items = SubOrder::where('seller_id', auth()->id())->get();
        $order_item_price;
        $str_order_id = "";
        
        foreach($order_items as $order_item){
            if($order_item->status == 'completed')
            foreach($order_item->items as $order_ent){
                $itemprice;
                $uniprice;
                $itemprice = $order_ent->price;
                if($order_ent->is_sale == 1){
                    $itemprice = $order_ent->price - (($order_ent->sale_pct_deduction/100) * $order_ent->price);
                }
                $uniprice = $itemprice * $order_ent->pivot->quantity;
                $total_sales += $uniprice;
                $str_order_id .= "\n " . $order_ent->pivot->quantity . $order_ent->name . $order_ent->price;
            }
        }

        $total_commission_deduction = 10;
        $total_sales_deduction = $total_sales - (($total_commission_deduction/100) * $total_sales);
        $total_sales_deduction_diff = $total_sales - $total_sales_deduction;
       
        
        // shop_title
        // shop_description
        // shop_order_count
        // shopAveRating
        // total_sales_deduction_diff
        return view('sellerPanel.dashboard')->with(compact('shop_title', 'shopProductsCount','shop_description', 'shop_order_count', 'shopAveRating', 'total_sales_deduction_diff'))->with('panel_name', 'dashboard');
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

        $orders = $_temp->where( $_col, $status_id )->get();
        // foreach ( $orders as $index => $value ) $orders->forget( $index );

        return view('sellerPanel.orders.index')->with(compact('orders', 'assign_order_status_options','is_pick_up','status_obj','category_type','status_id'))->with('panel_name', 'orders');
    
    }

    function product_index(){
        $products = Product::all();
        return view('sellerPanel.products.index')->with('panel_name', 'products')->with(compact('products'));
    }

    function pre_order_index(){
        
    }
}
