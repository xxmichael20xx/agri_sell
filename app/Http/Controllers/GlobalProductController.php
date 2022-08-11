<?php

namespace App\Http\Controllers;

use App\invalidIdreason;
use App\Product;
use App\ProductRating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GlobalProductController extends Controller
{
    public function rate( Request $request ) {
        $data = explode( ':', $request->data );

        $rating = $request->rate;
        $order_id = $data[0];
        $product_id = $data[1];
        $user_id = $data[2];

        $productRating = ProductRating::where( [ 'order_id' => $order_id, 'product_id' => $product_id, 'user_id' => $user_id ] )->first();

        if ( ! $productRating ) {
            $productRating = new ProductRating;
            $productRating->order_id = $order_id;
            $productRating->product_id = $product_id;
            $productRating->user_id = $user_id;
        }

        $productRating->rating = $rating;
        $productRating->save();

        return response()->json( [
            'success' => TRUE,
            'data' => $rating
        ] );
    }

    public function shippingRates( Request $request ) {
        $location_path = public_path() . '/province_municipality_barangay.json';
        $locations = json_decode( file_get_contents( $location_path ), true);

        $province = "Pangasinan";
        $town = "";
        $barangay = "";
        $rates = 0;

        foreach ( $locations as $location ) {
            $id = intval( $location['id'] );
            $name = trim( $location['name'] );

            if ( $id == $request->town && empty( $town ) ) $town = $name;
            if ( $id == $request->barangay && empty( $barangay ) ) $barangay = $name;
        }

        $cartItems = \Cart::session( auth()->user()->id )->getContent();
        $vendors = array();

        foreach( $cartItems as $item ) {
            $product_inst = Product::where('id', $item['product_id'])->first();
            array_push( $vendors, $product_inst->shop->owner->town );
        }

        foreach ( $vendors as $vendor ) {
            $rate = DB::table( 'shipping_fee_table_matrix' )
                ->where( 'customer_address', $town )
                ->where( 'shop_address', $vendor )
                ->first();

            if ( $rate ) $rates += $rate->shipping_fee;
        }

        if ( $rates < 1 ) $rates = 60;

        return response()->json( [
            'success' => true,
            'rate' => $rates
        ] );
    }
}
