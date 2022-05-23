@extends('riderPanel.front')

@section('content')
    <div class="content">
        <a href="/rider_dashboard" class="btn btn-outline-dark btn-round m-1 mb-2">Go back</a>
        <div class="row">
            <div class="col-5">
                <div class="card">
                    <div class="card-header">
                        <h5>Customer info</h5>
                    </div>
                    <div class="card-body">
                        <p>Name: {{ $order->order->user->name ?? 'not available' }}</p>
                        <p>Address: {{ $order->order->user->address ?? 'not available' }} {{ $order->order->user->barangay ?? 'not available' }} {{ $order->order->user->town ?? 'not available' }} {{ $order->order->user->province ?? 'not available' }}</p>
                        <p>Mobile: {{ $order->order->user->mobile ?? 'not available' }}
                    </div>
                </div>
            </div>
            <div class="col-7">
                <div class="card">
                    <div class="card-header">
                        <h5>Delivery info</h5>
                    </div>
                    <div class="card-body">
                        @if (isset($order->order->rider_id))
                            <p>Rider ID:{{ $order->order->rider->rider_id}}</p>
                            <p>Delivery man name:{{ $order->order->rider->user->name ?? 'not available'}}</p>
                            <p>Delivery man mobile:{{ $order->order->rider->user->mobile ?? 'not available'}}</p>
                            <p>Vehicle used: {{$order->order->rider->vehicle_used ?? 'not available'}} </p>
                            <p> Delivery status: {{$order->deliverystatus->display_name ?? 'not available'}} </p>
                        @else
                            <p>Delivery man not set</p>
                        @endif
                    </div>

                    <div class="card-footer">
                        <div class="row">
                            <div class="col col-6">

                                <div class="dropdown ">
                                    <button class="dropdown-toggle btn btn-warning btn-round btn-block " type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="false" aria-expanded="true">
                                        Assign delivery status
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right " aria-labelledby="dropdownMenuButton" style="will-change: transform; position: absolute; transform: translate3d(-25px, -173px, 0px); top: 0px; left: 0px;" x-placement="top-end">
                                        <div class="dropdown-header">Select delivery status option</div>
                                        @foreach ( $assign_order_status_options as $option )
                                            @if ($option->name != 'notdelivery')
                                                <a 
                                                    class="dropdown-item" 
                                                    href="/admin/edit_order_status/{{ $option->id }}/{{ $order->order_id }}"
                                                >
                                                    {{ $option->display_name }}
                                                </a>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row ">
            <div class="col-12">
                <div class="card  ">
                    <div class="card-header">
                        <h5>Order Summary</h5>
                    </div>
                    <div class="card-body">
                        <table class="table" class="table " cellspacing="0" width="100%">
                            <thead  class="text-primary">
                                <tr>
                                    <th>Name</th>
                                    <th>Qty</th>
                                    <th>Variety</th>
                                    <th>Net weight(kg)</th>
                                    <th>Price</th>
                                    <th>Sub total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach( $items as $index => $item )
                                    @php
                                        $product_variety_ent = App\ProductVariation::where('id', $item->pivot->variation_id)->first();
                                        $item_product_pivot = App\Product::where('id', $item->id)->first();
                                        $item_product_pivot_price = $item_product_pivot->price;
                                        $item_product_price_proc = 0;
                                        if ( $item_product_pivot->is_sale == 1 ) {
                                            $item_product_price_proc = $product_variety_ent->variation_price_per ?? '0' - (($item_product_pivot->sale_pct_deduction / 100) * $product_variety_ent->variation_price_per);

                                        } else {
                                            $item_product_price_proc = $product_variety_ent->variation_price_per;
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
                                            {{ AppHelpers::numeric( $item->pivot->quantity ) }}
                                        </td>
                                        <td>                            
                                            {{ $product_variety_ent->variation_name ?? '' }}
                                        </td>
                                        
                                        <td>
                                            @php
                                                $product_variety_ent = App\ProductVariation::where( 'id', $item->pivot->variation_id )->first();
                                            @endphp
                                            {{ $product_variety_ent->variation_net_weight ?? '' }}
                                        </td>
                                        <td>
                                            @if ( $item_product_pivot->is_sale == 1 )
                                                ₱ {{ $product_variety_ent->variation_price_per ?? '' }}
                                            @else
                                                ₱ {{ AppHelpers::numeric( $item_product_price_proc ) }}
                                            @endif 
                                        </td>
                                        <td>
                                            ₱ {{ AppHelpers::numeric( $item->pivot->quantity * $item->pivot->price ) }}
                                        </td>
                                        <td>
                                            <a href="/product_monitoring_status/{{ $item_id }}" class="btn btn-primary">Product monitoring</a>
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
                            {{-- <tr>
                                <td class="text-left">
                                    Shipping fee
                                </td>
                                <td class="text-right">
                                    @if ( $order->order->is_pick_up != 'yes' )
                                        ₱ {{ AppHelpers::numeric( $order->order->shipping_fee ) }}
                                    @endif
                                </td>
                            </tr> --}}
                            <tr>
                                <td class="text-left">
                                    Total
                                </td>
                                <td class="text-right">
                                    @if ( $order->order->is_pick_up != 'yes' )
                                        ₱ {{ AppHelpers::numeric( $order->order->grand_total ) }}
                                    @else
                                        ₱ {{ AppHelpers::numeric( $order->order->grand_total - $order->order->shipping_fee ) }}
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
