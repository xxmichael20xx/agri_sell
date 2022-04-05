<?php

namespace App\Http\Controllers;

use App\PreOrderModel;
use Illuminate\Http\Request;
use App\Order;
use App\Product;
use App\SubOrder;
use App\OrderItem;
use App\Shop;
use DB;
use Auth;
use App\deliveryStaffModel;
use App\orderDeliveryStatusModel;
class PreOrderController extends Controller
{
    function index(){
        $pre_orders = PreOrderModel::latest()->get();
        $assign_order_status_options = orderDeliveryStatusModel::all();
        if(Auth::user()->role->name == 'seller'){
            return view('sellerPanel.pre_orders.index')->with(compact('assign_order_status_options'))->with('panel_name', 'pre_orders')->with('pre_orders', $pre_orders);
        }else{
            return view('admin.pre_orders.index')->with(compact('pre_orders', 'assign_order_status_options'))->with('panel_name', 'pre_orders');
        }
    }

    function delete($pre_order_req_id){
        // delete the preorder instance after adding to orders
        $pre_order_inst_del = PreOrderModel::find($pre_order_req_id);
        $pre_order_inst_del->delete();
        return back();
    }

    
}
