<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SubOrder;
use App\Order;
use App\orderpickupStatusModel;
use App\orderDeliveryStatusModel;
class UserOrderMgmtPanelController extends Controller
{
    function index(){
        $orders = SubOrder::all();
        $assign_order_status_options = orderDeliveryStatusModel::all();
        return view('admin.order_mgmt.index')->with(compact('orders', 'assign_order_status_options'))->with('panel_name', 'orders');
    }

    function index_by_cat($cat_id){
        $orders = SubOrder::all();
        $assign_order_status_options = orderDeliveryStatusModel::all();
        return view('admin.order_mgmt.index')->with(compact('orders', 'assign_order_status_options'))->with('panel_name', 'orders');
    }

    function all(){
        $orders = SubOrder::all();
        return view('user_orders_all.index')->with('orders', $orders);
    }
    function show_by_cat($category_type, $status_id){
        $is_pick_up = ($category_type == 'pickup') ? 'yes' : 'no';
        if($is_pick_up != 'yes'){
            $orders = SubOrder::where('is_pick_up', $is_pick_up)->where('status_id', $status_id)->get();
            $status_obj = orderDeliveryStatusModel::find($status_id);
        }else{
            $orders = SubOrder::where('is_pick_up', $is_pick_up)->where('pick_up_status_id', $status_id)->get();
            $status_obj = orderpickupStatusModel::find($status_id);
        }
        $assign_order_status_options = orderDeliveryStatusModel::all();
        return view('user_orders.index')->with(compact('orders', 'assign_order_status_options','is_pick_up','status_obj'))->with('panel_name', 'orders');
    }

    public function show($order_id)
    {
        $order = Suborder::where('order_id', $order_id)->first();
        $items = $order->items;
        $assign_order_status_options = orderDeliveryStatusModel::all();
        $delivery_man_options = deliveryStaffModel::where('status', '!=', 'on_leave')->get();
        return view('admin.order_mgmt.show', compact('items', 'order', 'delivery_man_options', 'assign_order_status_options'))->with('panel_name', 'orders');
    }

    public function setOrderPaid($order_id){
        $order = Order::where('id', $order_id)->first();
        $order->is_paid = "1";
        $order->save();   
        return back();
    }

    public function setOrderUnPaid($order_id){
        $order = Order::where('id', $order_id)->first();
        $order->is_paid = "0";
        $order->save();
        return back();
    }
    // shipping and delivery status
    // db table orderdeliverystatus
    // model - orderDeliveryStatusModel
    // Waiting for seller to ship your parcel - Pending
    // Seller is preparing to ship your parcel - Manifested/Order confirmed
    // Parcel has been picked up by courier - Pickup_success
    // Parcel is out for delivery - On out for delivery
    // Parcel has been delivered - Completed
    // Delivery attempt was unsuccessful - Delivery failed
    public function markOrderDeliveryStatus($status_id, $order_id){
        $order = Suborder::where('order_id', $order_id)->first();
        // {{$order->deliverystatus->display_name}}
        $order->status_id = $status_id;
        $order->save(); 
        return back();
    }

    public function showOrderDeliveryPickUpStatus($status_id){
        $orders = SubOrder::all();
        $assign_order_status_options = orderDeliveryStatusModel::all();
        // return view('a')->with(compact('orders', 'assign_order_status_options'))->with('panel_name', 'orders');

    }
    public function markOrderPickUpStatus($status_id, $order_id){
        $order = Suborder::where('order_id', $order_id)->first();
        // {{$order->deliverystatus->display_name}}
        // $order->status_id = $status_id;
        $order->pick_up_status_id = $status_id;
        $order->save();
        return back();
    }
    public function assignRiderOrder($rider_id, $order_id){
        $order = Order::where('id', $order_id)->first();
        $order->rider_id = $rider_id;
        $order->save();
        return back();
    }

    // for seller show
    public function show_seller_order($order_id){
        $order = Suborder::where('order_id', $order_id)->where('seller_id', Auth::user()->id)->first();
        $items = $order->items;
        $assign_order_status_options = orderDeliveryStatusModel::all();
        $delivery_man_options = deliveryStaffModel::where('status', '!=', 'on_leave')->get();
        return view('sellerPanel.orders.show', compact('items', 'order', 'delivery_man_options', 'assign_order_status_options'))->with('panel_name', 'orders');
    }
}
