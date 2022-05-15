<?php
namespace App;
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\SubOrder;
use App\OrderItem;
use Auth;
use App\deliveryStaffModel;
use App\orderDeliveryStatusModel;
use App\coinsTopUpModel;
use App\SubOrderItem;

class RiderPanelController extends Controller
{
    function dashboard(){

    }

    function index() {
        $orders = SubOrder::where( 'is_pick_up', '!=', 'yes' )->get();
        $assign_order_status_options = orderDeliveryStatusModel::whereIn( 'id', array( 2, 3, 4 ) )->get();
        $my_rider_id = Auth::user()->rider_staff->id;

        foreach ( $orders as $index => $order ) {
            if ( ! $order->order ) $orders->forget( $index );
        }

        return view( 'riderPanel.dashboard' )
            ->with(compact('orders', 'assign_order_status_options'))
            ->with('panel_name', 'orders')
            ->with('my_rider_id', $my_rider_id);
    }


    public function show($order_id)
    {
        $order = Suborder::where('order_id', $order_id)->first();
        $items = $order->items;
        $assign_order_status_options = orderDeliveryStatusModel::all();
        $delivery_man_options = deliveryStaffModel::where('status', '!=', 'on_leave')->get();
        return view('admin.order_mgmt.show', compact('items', 'order', 'delivery_man_options', 'assign_order_status_options'))->with('panel_name', 'dashboard');
    }

    public function setOrderPaid($order_id){
        // order produktos  set order_items entity
        $order = Order::where('id', $order_id)->first();
        $order->is_paid = "1";

        // get item per id
        $order_items = OrderItem::where('order_id', $order_id)->get();
        foreach($order_items as $order_item){
            $coinsTopUpModel = new coinsTopUpModel();
            $coinsTopUpModel->user_id = $order_item->product->shop->user->id;
            $coinsTopUpModel->remarks = '1';
            $coinsTopUpModel->trans_id = 'order_item' . uniqid();
            $coinsTopUpModel->coins_trans_type = 'order_item_paid' . uniqid();
            $coinsTopUpModel->reference_id = 'COINS'. uniqid();
            $coinsTopUpModel->approved_by_user_id = '4';
            $coinsTopUpModel->save();
        }
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

    public function assignRiderOrder($rider_id, $order_id){
        $order = Order::where('id', $order_id)->first();
        $order->rider_id = $rider_id;
        $order->save();
        return back();
    }


    // for seller show

    public function show_seller_order( $order_id ) {
        $order = Suborder::where( 'order_id', $order_id )->first();

        if ( ! $order ) {
            $layout = "riderPanel.front";
            $backUrl = "/rider_dashboard";
            $panel_name = "";
            return view( '404' )->with( compact( 'layout', 'backUrl', 'panel_name' ) );
        }

        // $items = $order->items;
        $items = SubOrderItem::where( 'sub_order_id', $order_id )->get();
        $assign_order_status_options = orderDeliveryStatusModel::all();
        $delivery_man_options = deliveryStaffModel::where('status', '!=', 'on_leave')->get();
        $my_rider_id = Auth::user()->rider_staff->id;
        $panel_name = "Orders";

        return view('riderPanel.show')->with( compact(
            'panel_name', 'items', 'assign_order_status_options', 'delivery_man_options', 'order', 'my_rider_id'
        ) );
    }

    public function setOrderStatus($option_id, $order_id){
        $order = Suborder::where('order_id', $order_id)->first();
        $order->status = $option_id;
        $order->save();
        return back();
    }

    public function sellerStatus($opt_id){
        dd($opt_id);

    }

}
