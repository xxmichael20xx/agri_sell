@extends('sellerPanel.front')
@section('content')
<style>
    .text-focus {
        color: #64BCB4;
        font-weight: bold;
    }
</style>
<div class="content">
    <a href="/sellerpanel/products" class="btn btn-outline-dark btn-round m-1 mb-2">Go back</a>
    <div class="row">
        <div class="col col-12 col-sm-5">
            <div class="card">
                @php
                    $_product_var = DB::table('product_variations')->where('product_id', $product->id);
                    $product_variants = $_product_var->get();
                    $product_variation_max_price = $_product_var->max('variation_price_per'); 
                    $product_variation_min_price = $_product_var->min('variation_price_per');
                    $product_variation_count_qty = $_product_var->sum('variation_quantity');
                    $product_variation_range = ($product_variation_min_price != $product_variation_max_price) ? '₱' . $product_variation_min_price . '- ₱' . $product_variation_max_price : '₱ ' . $product_variation_max_price;
                    $product_variation_range_sale = ($product_variation_min_price != $product_variation_max_price) ? '₱' . $product_variation_min_price . '- ₱' . $product_variation_max_price : '₱ ' . ($product_variation_max_price - (($product->sale_pct_deduction/100) * $product->product_variation_max_price));
                @endphp
                <img src="{{ asset( 'storage/'.$product->featured_image ) }}">

                <div class="card-body">
                    <p class="h4">{{ $product->name }}</p>
                    <p class="h5"> {!! $product_variation_range !!}</p>
                    <p class="text-focus">{{ $product->shop->owner->name ?? '' }}</p>
                    <p><b>Sold per:</b> {{ $product_variants[0]->variation_sold_per }}</p>
                    <p><b>Available stocks:</b> {{ $product_variants[0]->variation_quantity }}</p>
                    <p><b>Product new weight:</b> {{ $product_variants[0]->variation_net_weight }}{{ $product_variants[0]->variation_net_weight_unit == 'kilogram' ? 'kg' : 'g' }}</p>
                    <p><b>Product type:</b> {{ $product_variants[0]->is_variation_wholesale ? 'Wholesale' : 'Retail' }}</p>
                    <p><b>Product description:</b> {!! $product->description !!}</p>
                </div>
                <div class="card-footer">
                    @if ( $product->is_sale == '1' )
                        <span class="badge badge-pill badge-danger">
                            Sale %{{ $product->sale_pct_deduction }}
                        </span>
                    @endif
                    @if ( $product->is_whole_sale == '1' )
                        <span class="badge badge-pill badge-danger">
                            Wholesale %{{ $product->sale_pct_deduction }}
                        </span>
                    @endif
                    <a class="btn btn-warning btn-round" href="/sellerpanel/product_edit/{{ $product->id }}">Edit</a>
                    <a class="btn btn-danger btn-round text-white" href=" /sellerpanel/delete_product/{{ $product->id }}">Delete</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
