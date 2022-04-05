<?php

namespace App\Http\Controllers;
use App\SubOrder;
use App\orderDeliveryStatusModel;
use Illuminate\Http\Request;
use App\deliveryStaffModel;
use App\SubOrderItem;

class ProductsMonitoringController extends Controller
{
    // disregard for now
    function index(){
        $orders = SubOrder::latest()->get();
        $assign_order_status_options = orderDeliveryStatusModel::all();
        return view('admin.product_monitoring.index')->with(compact('orders', 'assign_order_status_options'))->with('panel_name', 'products_monitoring');
    }

    public function show($order_id)
    {
        $order = Suborder::where('order_id', $order_id)->first();
        $items = $order->order->items;
        $assign_order_status_options = orderDeliveryStatusModel::all();
        $delivery_man_options = deliveryStaffModel::where('status', '!=', 'on_leave')->get();
        return view('admin.product_monitoring.show', compact('items', 'order', 'delivery_man_options', 'assign_order_status_options'))->with('panel_name', 'products_monitoring');
    }

    
}
