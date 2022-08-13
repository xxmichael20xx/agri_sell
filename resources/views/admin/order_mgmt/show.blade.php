@extends('admin.front')
@section('content')

<div class="content">
    <a href="/admin/manage_orders/pickup/1" class="btn btn-outline-dark btn-round m-1 mb-2">Go back</a>
    <div class="row mb-4">
        <div class="col-5">
            <div class="card h-100">
                <div class="card-header">
                    <h5>Customer info</h5>
                </div>
                <div class="card-body">
                    <p><b>Name:</b> {{ $order->order->user->name }}</p>
                    <p><b>Address:</b> {{ $order->order->user->address }} {{ $order->order->user->barangay }} {{ $order->order->user->town }} {{ $order->order->user->province }}</p>
                    <p><b>Mobile:</b> {{ $order->order->user->mobile }}

                    @if ( $order->order->is_pick_up == 'no' )
                        <p><b>Shipping Address:</b> {{ $order->order->shipping_address }} {{ $order->order->shipping_city }} {{ $order->order->shipping_barangay }} Pangasinan</p>
                    @endif
                </div>
            </div>
        </div>
        @if ($order->order->is_pick_up != "yes")
            <div class="col-7">
                <div class="card h-100">
                    <div class="card-header">
                        <h5>Delivery info</h5>
                    </div>
                    <div class="card-body">
                        @if (isset($order->order->rider_id))
                            <p><b>Rider ID:</b> {{ $order->order->rider->rider_id}}</p>
                            <p><b>Delivery man name:</b> {{ $order->order->rider->user->name}}</p>
                            <p><b>Delivery man mobile:</b> {{ $order->order->rider->user->mobile}}</p>
                            <p><b>Vehicle used:</b> {{$order->order->rider->vehicle_used}} </p>
                            <p><b>Delivery status:</b> {{$order->deliverystatus->display_name}} </p>
                        @else
                            <p>No assigned Delivery rider</p>
                        @endif
                    </div>
                </div>
            </div>
        @endif
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Order Summary</h5>
                </div>
                <div class="card-body">
                    <table class="table" class="table" cellspacing="0" width="100%">
                        <thead  class="text-primary">
                            <tr>
                                <th>Name</th>
                                <th>Qty</th>
                                <th>Variety</th>
                                <th>Net weight(kg)</th>
                                <th>Price</th>
                                <th>Sub total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $index => $item)
                                {{-- Get if the item has Sale or discounted price this will fix the regular price bug --}}        
                                @php
                                    $product_variety_ent = App\ProductVariation::where('id', $item->pivot->variation_id)->first();
                                    $item_product_pivot = App\Product::where('id', $item->id)->withTrashed()->first();
                                    $item_product_pivot_price = $item_product_pivot->price;
                                    $item_product_price_proc = 0;

                                    if ( $item_product_pivot->is_sale == 1 ) {
                                        $item_product_price_proc = $product_variety_ent->variation_price_per - (($item_product_pivot->sale_pct_deduction / 100) * $product_variety_ent->variation_price_per);
                                    } else {
                                        $item_product_price_proc =$product_variety_ent->variation_price_per;
                                    }

                                    $item_id = $item->id;
                                    if ( isset( $sub_ids[$index] ) ) {
                                        $item_id = $sub_ids[$index]->id;
                                    }
                                @endphp
                                <tr>
                                    <td scope="row">
                                        {{ $item->name }}
                                    </td>

                                    <td>
                                        {{ $item->pivot->quantity }}
                                    </td>

                                    <td>
                                        {{$product_variety_ent->variation_name ?? ''}}
                                    </td>

                                    <td>
                                        {{ $product_variety_ent->variation_net_weight ?? '' }}
                                    </td>

                                    <td>
                                        ₱ {{ AppHelpers::numeric( $item_product_price_proc ) }}
                                    </td>

                                    <td>
                                        ₱ {{ AppHelpers::numeric( $item->pivot->quantity * $item->pivot->price ) }}
                                    </td>

                                    <td>
                                        <a class="btn btn-primary" href="/admin_product_monitor/{{ $item_id }}">Product monitoring</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row justify-content-end">
        <div class="col-5">
            <div class="card">
                <div class="card-header">
                    <h5>Order totals</h5>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        @if ($order->order->is_pick_up != 'yes')
                            <tr>
                                <td class="text-left">
                                    Shipping fee
                                </td>
                                <td class="text-right">
                                    ₱ {{ AppHelpers::numeric( $order->order->shipping_fee ) }}
                                </td>
                            </tr>
                        @endif
                        <tr>
                            <td class="text-left">Total</td>
                            <td class="text-right">
                                @if ($order->order->is_pick_up == 'yes')
                                    ₱ {{ AppHelpers::numeric( $order->order->grand_total - $order->order->shipping_fee )}}
                                @else
                                    ₱ {{ AppHelpers::numeric( $order->order->grand_total + $order->order->shipping_fee )}}  
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
