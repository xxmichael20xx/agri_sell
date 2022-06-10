@extends('admin.front')
@section('content')
<div class="content">
    <a href="/admin/manage_products" class="btn btn-outline-dark btn-round m-1 mb-2">Go back</a>
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
            <div style="width: 100%; height: 320px;background-position: center;background-size: cover;background-image: url('/storage/{{$product->featured_image}}');"></div>
                <div class="card-header">
                    <h4>{{ $product->name }}</h4>
                    <h5>{!! $product_variation_range !!}</h5>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-12 mb-3">
                            <span class="text-muted">Product description:  {!! $product->description !!}</span>
                        </div>
                        <div class="col-12 mb-3">
                            <span class="text-muted">Sold by: {{ $product->shop->owner->name }}</span>
                        </div>
                    </div>
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection