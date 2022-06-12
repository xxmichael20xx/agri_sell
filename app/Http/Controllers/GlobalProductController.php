<?php

namespace App\Http\Controllers;

use App\ProductRating;
use Illuminate\Http\Request;

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
}
