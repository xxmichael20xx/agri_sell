@extends('sellerPanel.front')
@section('content')
<div class="content">
    <button onclick="history.go(-1)" class="btn btn-outline-dark btn-round m-1 mb-2">Go back</button>
    <div class="row">
        <div class="col col-12 col-lg-7">
            <div class="card">
                   @php
                 $product_variation_max_price = DB::table('product_variations')->where('product_id', $product->id)->max('variation_price_per'); 
                    $product_variation_min_price = DB::table('product_variations')->where('product_id', $product->id)->min('variation_price_per');
                    $product_variation_count_qty = DB::table('product_variations')->where('product_id', $product->id)->sum('variation_quantity');
                    $product_variation_range = ($product_variation_min_price != $product_variation_max_price) ? '₱' . $product_variation_min_price . '- ₱' . $product_variation_max_price : '₱ ' . $product_variation_max_price;
                    $product_variation_range_sale = ($product_variation_min_price != $product_variation_max_price) ? '₱' . $product_variation_min_price . '- ₱' . $product_variation_max_price : '₱ ' . ($product_variation_max_price - (($product->sale_pct_deduction/100) * $product->product_variation_max_price));
                @endphp
            <img src="{{asset('storage/'.$product->cover_img)}}"  >

                <div class="card-header">
                    <h4>{{$product->name}}</h4>
                    <h5> {!! $product_variation_range !!}</h5>
                </div>
                <div class="card-body">
                    Product description:  {!! $product->description !!}
                    Sold by: {{$product->shop->owner->name}}
                    <br>
                </div>
                <div class="card-footer">
                    @if ($product->is_sale == '1')
                    <span class="badge badge-pill badge-danger">
                        Sale %{{$product->sale_pct_deduction}}
                      </span>
                    @endif
                    @if ($product->is_whole_sale == '1')
                    <span class="badge badge-pill badge-danger">
                        Wholesale %{{$product->sale_pct_deduction}}
                      </span>
                    @endif
                    <a class="btn btn-warning btn-round" href="/sellerpanel/product_edit/{{$product->id}}">Edit</a>
                    <a class="btn btn-danger btn-round text-white" href=" /sellerpanel/delete_product/{{$product->id}}">Delete</a>
                   
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
