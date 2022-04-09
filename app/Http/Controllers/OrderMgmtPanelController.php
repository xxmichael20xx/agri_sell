<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Product;
use App\SubOrder;
use App\OrderItem;
use App\Shop;
use DB;
use Auth;
use App\deliveryStaffModel;
use App\Events\OrderEvent;
use App\notification;
use App\orderDeliveryStatusModel;
use App\orderpickupStatusModel;
use App\ProductMonitoringLogs;
use App\SubOrderItem;
use Carbon\Carbon;

class OrderMgmtPanelController extends Controller
{
    function index(){
     
        $orders = SubOrder::latest()->get();
        $assign_order_status_options = orderDeliveryStatusModel::all();
        return view('admin.order_mgmt.index')->with(compact('orders', 'assign_order_status_options'))->with('panel_name', 'orders');
  
    }

    function index_by_cat($cat_id){
        $orders = SubOrder::latest()->get();
        $assign_order_status_options = orderDeliveryStatusModel::all();
        return view('admin.order_mgmt.index')->with(compact('orders', 'assign_order_status_options'))->with('panel_name', 'orders');
    }

    function show_by_cat($category_type, $status_id){
        $is_pick_up = ($category_type == 'pickup') ? 'yes' : 'no';
        if($is_pick_up != 'yes'){
            $orders = SubOrder::where('is_pick_up', $is_pick_up)->where('status_id', $status_id)->latest()->get();
            $status_obj = orderDeliveryStatusModel::find($status_id);
        }else{
            $orders = SubOrder::where('is_pick_up', $is_pick_up)->where('pick_up_status_id', $status_id)->latest()->get();
            $status_obj = orderpickupStatusModel::find($status_id);
        }
        $assign_order_status_options = orderDeliveryStatusModel::all();
        return view('admin.order_mgmt.index')->with(compact('orders', 'assign_order_status_options','is_pick_up','status_obj'))->with('panel_name', 'orders');
    }

    public function show($order_id)
    {
        $order = Suborder::where('order_id', $order_id)->first();
        $items = $order->order->items;

        $assign_order_status_options = orderDeliveryStatusModel::all();
        $delivery_man_options = deliveryStaffModel::where('status', '!=', 'on_leave')->get();
        return view('admin.order_mgmt.show', compact('items', 'order', 'delivery_man_options', 'assign_order_status_options'))->with('panel_name', 'orders');
    }

    // for product monitoring index
    public function showSingleSubItemSingle($suborder_item_id)
    {
        // note for product monitoring make sure that your product is only for the shop that has been selected
        $order_item = SubOrderItem::where('id', $suborder_item_id)->first();
        $product_monitoring_logs = ProductMonitoringLogs::where('sub_order_item_id', $suborder_item_id)->get();  
        if(Auth::user()->role->name == 'seller'){
            return view('sellerPanel.orders.product_monitoring_w_setter')->with('product_monitoring_logs', $product_monitoring_logs)->with('order_item', $order_item)->with('panel_name', 'orders')->with('suborder_item_id', $suborder_item_id);
        }else if(Auth::user()->role->name == 'admin'){
            return view('admin.order_mgmt.suborder_item_monitoring')->with('product_monitoring_logs', $product_monitoring_logs)->with('order_item', $order_item)->with('panel_name', 'orders');
        }else if(Auth::user()->role->name == 'rider'){
            return view('riderPanel.show_product_monitoring')->with('product_monitoring_logs', $product_monitoring_logs)->with('order_item', $order_item)->with('panel_name', 'orders')->with('suborder_item_id', $suborder_item_id);
        }
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
        $sub_order = Suborder::where('order_id', $order_id)->first();
        // {{$order->deliverystatus->display_name}}
        $sub_order->status_id = $status_id;
        $sub_order->save();

        $this->checkStatuses( 'order_status', $status_id, $order_id );
        return back();
    }

    public function showOrderDeliveryPickUpStatus($status_id){
        $orders = SubOrder::all();
        $assign_order_status_options = orderDeliveryStatusModel::all();
        // return view('a')->with(compact('orders', 'assign_order_status_options'))->with('panel_name', 'orders');

    }
    public function markOrderPickUpStatus($status_id, $order_id){
        $sub_order = Suborder::where('order_id', $order_id)->first();
        // {{$sub_order->deliverystatus->display_name}}
        // $sub_order->status_id = $status_id;
        $sub_order->pick_up_status_id = $status_id;
        $sub_order->save();
        
        $this->checkStatuses( 'pickup_status', $status_id, $order_id );
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
        // $order = Suborder::where('order_id', $order_id)->where('seller_id', Auth::user()->id)->first();
        // $items = $order->items;
        // $assign_order_status_options = orderDeliveryStatusModel::all();
        // $delivery_man_options = deliveryStaffModel::where('status', '!=', 'on_leave')->get();
        // return view('sellerPanel.orders.show', compact('items', 'order', 'delivery_man_options', 'assign_order_status_options'))->with('panel_name', 'orders');
       
        $order = Suborder::where('order_id', $order_id)->where('seller_id', Auth::user()->id)->first();
        $items = $order->order->items;

        $assign_order_status_options = orderDeliveryStatusModel::all();
        $delivery_man_options = deliveryStaffModel::where('status', '!=', 'on_leave')->get();
        return view('sellerPanel.orders.show', compact('items', 'order', 'delivery_man_options', 'assign_order_status_options'))->with('panel_name', 'orders');

   
    }
    
    public function addProductMonitoringLogs(Request $req){
        $product_monitoring_logs = new ProductMonitoringLogs();
        $multiple_images = $req->file('images');
        $user_id = Auth::user()->id;
        $multiple_images_path = '';
        // standby mulltiple image upload 
        if($req->hasFile('images')){
            foreach($multiple_images as $single_image){
                $productImage = $single_image;
                $productImageSaveAsName = time() . uniqid() . "-product." . $productImage->getClientOriginalExtension();
                $upload_path = 'storage/products/' . date('FY') . '/';
                $upload_path_url = 'products//' . date('FY') . '//';
                $product_image_url = $upload_path_url . $productImageSaveAsName;
                $success = $productImage->move($upload_path, $productImageSaveAsName);
                $multiple_images_path .= $product_image_url . ',';
              
            }
        }
        $product_monitoring_logs->user_id = $user_id;
        $product_monitoring_logs->images = $multiple_images_path;
        $product_monitoring_logs->sub_order_item_id = $req->product_sub_order_id;
        $product_monitoring_logs->status = $req->prod_status_names;
        
        $product_monitoring_logs->save();
        return back();

    }

    /**
     * Check for the status for pick up and order
     * @param config_key File name from config directory
     * @param status_id Status id
     * @param order_id Order Id
     * @return Void
     */
    public function checkStatuses( $config_key, $status_id, $order_id ) {
        $statuses = config( $config_key );
        $order = Order::find( $order_id );
        $currentTime = Carbon::parse( time() )->format( 'M d, Y h:i:s' );

        foreach ( $statuses as $key => $status ) {
            if ( $key == $status_id && $order ) {

                $title = "Your order has been marked as `{$status}`";
                $title .= "<br> Date notified: {$currentTime}<br><br>";

                $notifData = [
                    'user_id' => $order->user_id,
                    'frm_user_id' => $this->userId(),
                    'notification_title' => "Order #{$order_id} Updated",
                    'notification_txt' => $title,
                ];
                $eventData = [ 
                    'customer_id' => $order->user_id, 
                    'type' => 'customer-order-update'
                ];
                $this->newNotificationWithEvent( $notifData, true, $eventData );
                break;
            }
        }
    }
}
