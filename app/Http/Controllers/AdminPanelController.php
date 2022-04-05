<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\adminNotifModel;
class AdminPanelController extends Controller
{
    function dashboard(){
         $notifs = adminNotifModel::latest()->get();
        $total_order_qty = DB::table('orders')->count();
        $total_revenue_by_shipping_fee = DB::table('orders')->sum('shipping_fee');
        $ag_coins_spends_total = DB::table('coins_transaction')->sum('value');
        $shop_count = DB::table('shops')->count();
        $buyer_acc_count = DB::table('users')->where('role_id', '!=', '1')->where('role_id', '!=', '5')->count();
        $rider_acc_count = DB::table('users')->where('role_id', '5')->count();
        $product_count = DB::table('products')->count();
        $order_qty_total = DB::table('orders')->sum('item_count');
        $ag_coins_topped_up_total = DB::table('coins_top_up')->where('remarks', '1')->sum('value');
        
        return view('admin.dashboard')->with(compact('total_order_qty', 'total_revenue_by_shipping_fee', 'shop_count', 'buyer_acc_count', 'rider_acc_count'))
                                    ->with(compact('product_count', 'order_qty_total', 'ag_coins_topped_up_total', 'ag_coins_spends_total'))->with('panel_name', 'dashboard')->with('notifs', $notifs);
    }

    
}
