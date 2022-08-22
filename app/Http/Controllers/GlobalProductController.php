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
        // Get and parse the JSON file containing the list of provinces and barangays
        $location_path = public_path() . '/province_municipality_barangay.json';
        $locations = json_decode( file_get_contents( $location_path ), true);

        $town = "";
        $barangay = "";
        $rates = 0;

        // Loop through all locations
        foreach ( $locations as $location ) {
            $id = intval( $location['id'] ); // Changed the data type from string to integer
            $name = trim( $location['name'] ); // Removed the before/after spaces on the location

            // Checked if the id is equals to the selected town and barangay
            if ( $id == $request->town && empty( $town ) ) $town = $name;
            if ( $id == $request->barangay && empty( $barangay ) ) $barangay = $name;
        }

        $cartSession = \Cart::session( auth()->user()->id ); // Initialized the Livewire Cart Session
        $cartItems = $cartSession->getContent(); // Fetched the cart items
        $vendors = array();

        // Looped through all of the cart items
        foreach( $cartItems as $item ) {
            $product_inst = Product::where( 'id', $item['product_id'] )->first();
            array_push( $vendors, $product_inst->shop->owner->town ); // Pushed the vendors of each products into an array
            // Array is a list of items.
            // i.e Folder is the container, items is the pages/coupons
        }

        // Removed the duplicate shop vendors
        $vendors = array_unique( $vendors );

        // Looped through all of the unique vendors
        foreach ( $vendors as $vendor ) {
            $rate = DB::table( 'shipping_fee_table_matrix' )
                ->where( 'customer_address', $town )
                ->where( 'shop_address', $vendor )
                ->first();

            // Added the rates
            if ( $rate ) $rates += $rate->shipping_fee;
        }

        if ( $rates < 1 ) $rates = 60;

        // Changed the number format
        $total = number_format( $cartSession->getTotal( false, $town ) );

        // returned a laravel JSON response to the frontend/website
        return response()->json( [
            'success' => true,
            'rate' => $rates,
            'total' => $total
        ] );
    }
}
