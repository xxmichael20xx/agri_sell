<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\adminNotifModel;
use App\Product;
use App\Rules\BdayRule;
use App\Shop;
use App\User;

class AdminPanelController extends Controller
{
    public function profileIndex() {
        $panel_name = 'Profile';
        $admin = auth()->user();

        return view( 'admin.profile', compact( 'panel_name', 'admin' ) );
    }

    public function profileUpdate( Request $request ) {
        if ( ! $request->province ) $request->merge( [ 'province' => 1 ] );

        $this->validate( $request, [
            'address' => ['required'],
            'mobile' => ['required', 'regex:/^[0-9]{11}+$/'],
            'bday' => ['required', new BdayRule],
            'province' => ['required'],
            'town' => ['required'],
            'barangay' => ['required'],
        ] );
        
        $location_path = public_path() . '/province_municipality_barangay.json';
        $location = json_decode( file_get_contents( $location_path ), true);

        $province = "Pangasinan";
        $town = "";
        $barangay = "";

        foreach ( $location as $_location ) {
            if ( $_location['id'] == $request->town && ! $town ) $town = $_location['name'];
            if ( $_location['id'] == $request->barangay && ! $barangay ) $barangay = $_location['name'];
        }

        $user_id = auth()->user()->id;
        $user = User::find( $user_id );
        $user->address = $request->address;
        $user->mobile = $request->mobile;
        $user->bday = $request->bday;
        $user->province = trim( $province );
        $user->town = trim( $town );
        $user->barangay = trim( $barangay );
        $user->save();

        return back()->with( 'info', 'Profile has been updated.' );
    }

    function dashboard(){
        $notifs = adminNotifModel::latest()->get();
        $total_order_qty = DB::table('orders')->count();
        $total_revenue_by_shipping_fee = DB::table('orders')->sum('shipping_fee');
        $ag_coins_spends_total = DB::table('coins_transaction')->sum('value');
        $shops = Shop::where( 'is_active', 1 )->where( 'date_approved', '!=', NULL )->get();
        // $buyer_acc_count = DB::table('users')->where('role_id', '!=', '1')->where('role_id', '!=', '5')->count();
        $buyer_acc_count = DB::table( 'users' )->where( 'role_id', '2' )->count();
        $rider_acc_count = DB::table('users')->where('role_id', '5')->count();
        // $product_count = DB::table('products')->count();
        $product_count = Product::latest()->count();
        $order_qty_total = DB::table('orders')->sum('item_count');
        $ag_coins_topped_up_total = DB::table('coins_top_up')->where('remarks', '1')->sum('value');

        foreach ( $shops as $shop_index => $shop ) {
            if ( ! $shop->owner ) $shops->forget( $shop_index );
        }

        $shop_count = count( $shops );

        return view( 'admin.dashboard' )
            ->with( compact( 
                'total_order_qty', 
                'total_revenue_by_shipping_fee', 
                'shop_count', 
                'buyer_acc_count', 
                'rider_acc_count'
            ) )
            ->with( compact( 
                'product_count', 
                'order_qty_total', 
                'ag_coins_topped_up_total', 
                'ag_coins_spends_total'
            ) )
            ->with( 'panel_name', 'dashboard' )
            ->with( 'notifs', $notifs );
    }

    
}
