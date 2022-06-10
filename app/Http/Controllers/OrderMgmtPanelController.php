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

    function show_by_cat( $category_type, $status_id ) {
        $is_pick_up = ( $category_type == 'pickup' ) ? 'yes' : 'no';
        $_temp = SubOrder::where( 'is_pick_up', $is_pick_up );
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

        return view( 'admin.order_mgmt.index' )
            ->with( compact( 'orders', 'assign_order_status_options', 'is_pick_up', 'status_obj', 'category_type', 'status_id' ) )
            ->with( 'panel_name', 'orders' );
    }

    public function show($order_id)
    {
        $order = Suborder::where('order_id', $order_id)->first();
        $items = $order->order->items;
        $sub_ids = SubOrderItem::where( 'sub_order_id', $order->id )->get();

        $assign_order_status_options = orderDeliveryStatusModel::all();
        $delivery_man_options = deliveryStaffModel::where('status', '!=', 'on_leave')->get();
        return view('admin.order_mgmt.show', compact('items', 'sub_ids', 'order', 'delivery_man_options', 'assign_order_status_options'))->with('panel_name', 'orders');
    }

    // for product monitoring index
    public function showSingleSubItemSingle( $suborder_item_id ) {
        // note for product monitoring make sure that your product is only for the shop that has been selected
        $order_item = SubOrderItem::where( 'id', $suborder_item_id )->first();
        $product_monitoring_logs = ProductMonitoringLogs::where( 'sub_order_item_id', $suborder_item_id )->get();

        if ( Auth::user()->role->name == 'seller' ) {
            return view('sellerPanel.orders.product_monitoring_w_setter')
                ->with('product_monitoring_logs', $product_monitoring_logs)
                ->with('order_item', $order_item)->with('panel_name', 'orders')
                ->with('suborder_item_id', $suborder_item_id);

        } else if ( Auth::user()->role->name == 'admin' ) {
            return view('admin.order_mgmt.suborder_item_monitoring')
                ->with('product_monitoring_logs', $product_monitoring_logs)
                ->with('order_item', $order_item)
                ->with('panel_name', 'orders');

        } else if ( Auth::user()->role->name == 'rider' ) {
            return view('riderPanel.show_product_monitoring')
                ->with('product_monitoring_logs', $product_monitoring_logs)
                ->with('order_item', $order_item)
                ->with('panel_name', 'orders')
                ->with('suborder_item_id', $suborder_item_id);

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
        $sub_order->status_id = $status_id;

        if ( $status_id == 5 ) {
            $order = Order::find( $order_id );
            $order->is_paid = true;
            $order->status = "completed";
            $order->save();
        }

        if ( $status_id == 5 ) {
            $sub_order->status = 'completed';
        }
        $sub_order->save();

        $this->checkStatuses( 'order_status', $status_id, $order_id );
        return back();
    }

    public function showOrderDeliveryPickUpStatus($status_id){
        $orders = SubOrder::all();
        $assign_order_status_options = orderDeliveryStatusModel::all();
        // return view('a')->with(compact('orders', 'assign_order_status_options'))->with('panel_name', 'orders');

    }

    // Set Pickup Order Status
    public function markOrderPickUpStatus( $status_id, $order_id ) {
        $seller_id = Auth::user()->id;
        $sub_order = Suborder::where( 'order_id', $order_id )->where( 'seller_id', $seller_id )->first();

        // {{$sub_order->deliverystatus->display_name}}
        // $sub_order->status_id = $status_id;
        $sub_order->pick_up_status_id = $status_id;
        
        if ( $status_id == 5 ) {
            $sub_order->status = 'completed';
            $sub_order->payout_request = true;
        }

        $sub_order->save();
        
        $this->checkStatuses( 'pickup_status', $status_id, $order_id );
        return back();
    }

    // Set Delivery status
    public function editDeliveryStatus( Request $request ) {
        $seller_id = Auth::user()->id;
        $order_id = $request->order_id;
        $status_id = $request->status_id;

        $sub_order = Suborder::where( 'order_id', $order_id )->where( 'seller_id', $seller_id )->first();
        $sub_order->status_id = $status_id;
        $sub_order->pick_up_status_id = $status_id;
        $sub_order->order_notes = $request->reason;

        if ( $status_id == 5 ) {
            $sub_order->status = 'completed';
            $sub_order->payout_request = true;
        }

        $sub_order->save();

        if ( $status_id == 6 ) {
            $order = Order::find( $order_id );
            $order->is_paid = false;
            $order->status = "pending";
            $order->save();
        }
        
        $this->checkStatuses( 'order_status', $status_id, $order_id );
        return redirect( '/rider_dashboard' );
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
        $sub_ids = SubOrderItem::where( 'sub_order_id', $order->id )->get();

        $_order_status_list = config( 'order_status' );
        $assign_order_status_options = orderDeliveryStatusModel::all();
        $delivery_man_options = deliveryStaffModel::where('status', '!=', 'on_leave')->get();
        return view('sellerPanel.orders.show', compact('items', 'sub_ids', 'order', 'delivery_man_options', 'assign_order_status_options', '_order_status_list'))->with('panel_name', 'orders');

   
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
    public function checkStatuses( $config_key, $status_id, $order_id, $request = NULL ) {
        $statuses = config( $config_key );
        $order = Order::find( $order_id );
        $subOrder = SubOrder::where( 'order_id', $order_id )->first();
        $sub_ids = SubOrderItem::where( 'sub_order_id', $subOrder->id )->get();
        // $currentTime = Carbon::parse( time() )->format( 'M d, Y h:i:s' );

        foreach ( $statuses as $key => $status ) {
            if ( $key == $status_id && $order ) {
                $title = "Your order has been marked as <span style='color: #28A745;'>'{$status}'</span>";
                if ( ( $config_key == 'pickup_status' && $status_id == 3 ) || ( $config_key == 'order_status' && $status_id == 7 ) ) {
                    $title .= "<br>Cancelation reason: " . $request->cancel_reason;
                }
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

                foreach ( $sub_ids as $sub_id ) {
                    $log = ProductMonitoringLogs::where( 'sub_order_item_id', $sub_id->id )->first();
                    $log->status = $status;
                    $log->save();
                }

                break;
            }
        }
    }
    
    public function editOrderStatus( Request $request ) {
        $order_id = $request->order_id;
        $status_id = $request->status_id;
        $is_delivery = isset( $request->type );

        $sub_order = Suborder::where( 'order_id', $order_id )->first();
        $sub_order->status_id = $status_id;
        $sub_order->pick_up_status_id = $status_id;
        $sub_order->order_notes = $request->cancel_reason;
        $sub_order->save();

        if ( in_array( $status_id, [ 6, 7 ] ) ) {
            $order = Order::find( $order_id );
            $order->is_paid = false;
            $order->status = "pending";
            $order->save();
        }
        
        // order_status or pickup_status
        $_status = $is_delivery ? 'order_status' : 'pickup_status';
        $this->checkStatuses( $_status, $status_id, $order_id, $request );
        return back();
    }
}
