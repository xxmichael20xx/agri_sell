@extends('sellerPanel.front')

@section('content')
<div class="content">
    <a href="/sellerpanel/manage_orders/pickup/1" class="btn btn-outline-dark btn-round m-1 mb-2">Go back</a>

    <div class="row mb-4">
        <div class="col-5">
            <div class="card h-100">
                <div class="card-header">
                    <h5>Customer info</h5>
                </div>
                <div class="card-body">
                    <p><b>Name:</b> {{$order->order->user->name}}</p>
                    <p><b>Address:</b> {{$order->order->user->address}} {{$order->order->user->barangay}} {{$order->order->user->town}} {{$order->order->user->province}}</p>
                    <p><b>Mobile:</b> {{$order->order->user->mobile}}

                    @if ( $order->order->is_pick_up == 'no' )
                        <p><b>Shipping Address:</b> {{ $order->order->shipping_address }} {{ $order->order->shipping_city }} {{ $order->order->shipping_barangay }} Pangasinan</p>
                    @endif
                </div>
            </div>
        </div>
        @if ( $order->order->is_pick_up != "yes" )
            <div class="col-7">
                <div class="card h-100">
                    <div class="card-header">
                        <h5>Delivery info - {{ $order->deliverystatus->display_name }}</h5>
                    </div>
                    <div class="card-body">
                        @if ( isset( $order->order->rider_id ) && isset( $order->order->rider->user ) )
                            <p><b>Rider ID:</b> {{ $order->order->rider->rider_id }}</p>
                            <p><b>Delivery man name:</b> {{ $order->order->rider->user->name ?? '-' }}</p>
                            <p><b>Delivery man mobile:</b> {{ $order->order->rider->user->mobile ?? '-' }}</p>
                            <p><b>Vehicle used:</b> {{$order->order->rider->vehicle_used ?? '-' }} </p>
                            {{-- <p><b>Delivery status:</b> {{$order->deliverystatus->display_name ?? '-' }} </p> --}}
                        @else
                            <p>No assigned Delivery rider</p>
                        @endif
                    </div>
                </div>
            </div>
        @else
            <div class="col-7">
                <div class="card h-100">
                    <div class="card-header">
                        <h5>Pick up info - {{ $order->pickupstatus->display_name }}</h5>
                    </div>
                    <div class="card-body">
                        <p><b>User ID:</b> {{ $order->order->user_id }}</p>
                        {{-- <p><b>Pickup status:</b> <span class="badge badge-info">{{ $order->pickupstatus->display_name ?? '' }}</span></p> --}}
                        <p><b>Order last updated:</b> {{ AppHelpers::humanDate( $order->updated_at ) }}</p>
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
                        <thead class="text-primary">
                            <tr>
                                <th>Name</th>
                                <th>Qty</th>
                                {{-- <th>Variety</th> --}}
                                <th>Net weight(kg)</th>
                                <th>Price</th>
                                <th>Sub Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach( $items as $index => $item )
                                {{-- Get if the item has Sale or discounted price this will fix the regular price bug --}}        
                                @php
                                    $product_variety_ent = App\ProductVariation::where('id', $item->pivot->variation_id)->first();
                                    $item_product_pivot = App\Product::withTrashed()->where('id', $item->id)->first();
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
                                    {{-- <td>                            
                                        {{ $product_variety_ent->variation_name ?? '' }}
                                    </td> --}}
                                    
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
                                        <a href="/seller_product_monitor/{{ $item_id }}" class="btn btn-primary">Product monitoring</a>
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
                        @if ( $order->order->is_pick_up != 'yes' )
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

    <div class="row">
        <div class="col-12 d-flex justify-content-end">
            @if ( ( $order->is_pick_up == 'yes' && $order->pick_up_status_id == '1' ) || ( $order->is_pick_up == 'no' && $order->status_id == '1' ) )
                @php
                    $prefix = ( $order->is_pick_up == 'yes' ) ? 'edit_pickup_status/6/' : 'edit_order_status/2/';
                @endphp
                <button type="button" class="btn btn-primary btn-round btn-pickup" data-href="/{{ $prefix }}{{ $order->order_id }}" data-title="Confirmed">Confirm</button>
                <button type="button" class="btn btn-danger btn-round" data-toggle="modal" data-target="#cancelOrderModal-{{ $order->order_id }}">Cancel</button>    

                <div class="modal fade" id="cancelOrderModal-{{ $order->order_id }}">
                    <div class="modal-dialog">
                        <form method="POST" action="{{ route( 'order.order.update' ) }}">
                            <div class="modal-content">
                                @csrf
                                <input type="hidden" name="order_id" value="{{ $order->order_id }}">
                                <input type="hidden" name="status_id" value="3">
                                <div class="modal-header">
                                    <h5 class="modal-title">Cancel Order</h5>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group row">
                                        <div class="col-12">
                                            <label for="cancel_reason" class="col-form-label">Reason for cancelling</label>
                                            <select class="custom-select" name="cancel_reason" id="cancel_reason" required>
                                                <option value="" selected disabled>Select a reason</option>
                                                <option value="Order quantity can't be fulfilled">Order quantity can't be fulfilled</option>
                                                <option value="Possible fraud">Possible fraud</option>
                                                <option value="Others">Others</option>
                                            </select>
                                            <textarea class="form-control mt-2 collapse" name="cancel_reason_others" id="cancel_reason_others" rows="5" placeholder="Please provide a reason"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-danger">Cancel order</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('custom-scripts')
    <script>
        (function($) {
            $(document).ready(function() {
                $( document ).on( 'click', '.btn-confirm,.btn-pickup,.btn-delivery', function() {
                    const href = $( this ).data( 'href' )
                    const title = $( this ).data( 'title' )

                    Swal.fire({
                        icon: 'warning',
                        title: 'Are you sure?',
                        text: `Order status will be changed to '${title}'`,
                        showCancelButton: true,
                        confirmButtonColor: '#219F94',
                        confirmButtonText: 'Yes, proceed'
                    }).then( ( result ) => {
                        if ( result.value ) {
                            window.location.href = href
                        }
                    } )
                } )

                $( document ).on( 'change', '#cancel_reason', function() {
                    const val = $( this ).val()
                    const others = $( '#cancel_reason_others' )

                    if ( val == 'Others' ) {
                        others.attr( 'required', true )
                        others.removeClass( 'collapse' )

                    } else {
                        others.attr( 'required', false )
                        others.addClass( 'collapse' )
                        others.val( '' )
                    }
                } )
            })
        })(jQuery)
    </script>
@endsection
