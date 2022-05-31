@extends('admin.front')
@section('content')
<style>
    .dropdown.bootstrap-select {
        width: 100% !important;
    }
</style>
<div class="content">
    <a href="/admin/manage_refunds/" class="btn btn-outline-dark btn-round mb-4">Go back</a>

    <div class="row">
        <div class="col-12 col-md-7">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Refund details</h5>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-12 mb-4">
                            <div class="refund--images">
                                @foreach ( $refund->expl_images as $image)
                                    <img src="/storage/{{ $image }}" class="img-fluid w-50">
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12 mb-3">
                            <span class="text-muted">Name of buyer: {{ $refund->customer->name }}</span>
                        </div>
                        <div class="col-12 mb-3">
                            <span class="text-muted">Shop name: {{ $refund->product->shop->name }}</span>
                        </div>
                        <div class="col-12 mb-3">
                            <span class="text-muted">Reason: {{ $refund->refund_reason_prod_txt }}</span>
                        </div>
                        <div class="col-12 mb-3">
                            <span class="text-muted">Amount: ₱ {{ AppHelpers::numeric( $refund->order_item->price * $refund->order_item->quantity ) }}</span>
                        </div>
                        @if ( $refund->status == '2' )
                            <div class="col-12 mb-3">
                                <span class="text-muted">Reason for rejecting: {{ $refund->reason }}</span>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="card-footer">
                    @if ( $refund->status == '0' )
                        <button type="buttom" class="btn btn-outline-info btn-round m-1 text-danger btn-action" data-action="rejected" data-href="/api/admin/refund/reject/{{ $id }}">Reject Refund</button>
                        <button type="buttom" class="btn btn-outline-info btn-round m-1 text-info btn-action" data-action="confirmed" data-href="/admin/manage_refunds/update/{{ $id }}/1">Confirm Refund</button>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-12 col-md-5">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Order details</h5>
                </div>
                <div class="card-body">
                    @if ( isset( $refund->order->suborder_ent->order->rider_id ) && isset( $refund->order->suborder_ent->order->rider->user ) )
                        <p>Rider ID:{{ $refund->order->suborder_ent->order->rider->rider_id }}</p>
                        <p>Delivery man name:{{ $refund->order->suborder_ent->order->rider->user->name ?? '' }}</p>
                        <p>Delivery man mobile:{{ $refund->order->suborder_ent->order->rider->user->mobile ?? '' }}</p>
                        <p>Vehicle used: {{ $refund->order->suborder_ent->order->rider->vehicle_used ?? '' }} </p>
                        <p>Delivery status: <span class="badge badge-info">{{ $refund->order->suborder_ent->deliverystatus->display_name ?? '' }}</span></p>
                    @else
                        <p>Delivery man not set</p>
                    @endif
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Order items</h5>
                </div>
                <div class="card-body">
                    <table class="table" class="table" cellspacing="0" width="100%">
                        <thead class="text-primary">
                            <tr>
                                <th>Name</th>
                                <th>Qty</th>
                                <th>Net weight(kg)</th>
                                <th>Price</th>
                                <th>Sub Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach( $refund->order->suborder_ent->order->items as $index => $item )
                                @php
                                    $product_variety_ent = App\ProductVariation::where('id', $item->pivot->variation_id)->first();
                                    $item_product_pivot = App\Product::where('id', $item->id)->first();
                                    $item_product_price_proc = $product_variety_ent->variation_price_per;
                                @endphp
                                <tr>
                                    <td scope="row">
                                        {{ $item->name }}
                                    </td>

                                    <td>
                                        {{ AppHelpers::numeric( $item->pivot->quantity ) }}
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
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section( 'admin.custom_scripts' )
    <script>
        (function($) {
            $(document).ready(function() {

                $( '.refund--images' ).slick({
                    infinite: true,
                    slidesToShow: 1,
                    dots: false,
                    prevArrow: false,
                    nextArrow: false
                })

                $( document ).on( 'click', '.btn-action', function() {
                    const href = $( this ).data( 'href' )
                    const action = $( this ).data( 'action' )
                    const user_id = {{ Auth::user()->id }}

                    if ( action == 'rejected' ) {
                        
                        Swal.fire({
                            icon: 'info',
                            title: 'Please provide a reason for rejecting refund request',
                            html: `<textarea id="refund--reject-reason" class="swal2-input" rows="5" autocomplete="off"></textarea>`,
                            showCancelButton: true,
                            confirmButtonText: 'Submit',
                            showLoaderOnConfirm: true,
                            preConfirm: () => {
                                const reason = Swal.getPopup().querySelector( '#refund--reject-reason' ).value

                                if ( document.getElementById( 'refund--reject-reason' ).value ) {
                                    return fetch( href, {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                        },
                                        body: JSON.stringify({ reason: reason, user_id: user_id }) 
                                    }).then( response => {
                                        if ( ! response.ok ) {
                                            throw new Error( response.statusText )
                                        }
                                        return response.json()
                                    }).catch( error => {
                                        Swal.showValidationMessage(
                                            `Request failed: ${error}`
                                        )
                                    } )

                                } else {
                                    Swal.showValidationMessage( 'Reason is required for rejecting a refund.' )   
                                }
                            },
                            allowOutsideClick: () => ! Swal.isLoading()
                            }).then( ( result ) => {
                                if ( result.value ) {
                                    if ( result?.value?.success ) {
                                        Swal.fire({
                                            icon: 'info',
                                            title: 'Refund request has been rejected!'
                                        }).then( () => {
                                            window.location.reload()
                                        } )
                                    } else {
                                        Swal.fire({
                                            icon: 'info',
                                            title: 'Failed to reject refund request!'
                                        })
                                    }
                                }
                        } )
                    } else {

                        Swal.fire({
                            icon: 'warning',
                            title: 'Are you sure?',
                            text: `Refund will be marked as "${action}"`,
                            showCancelButton: true,
                            confirmButtonColor: '#219F94',
                            confirmButtonText: 'Yes, proceed'
                        }).then( ( result ) => {
                            if ( result.value ) window.location.href = href
                        })
                    }

                } )

            })
        })(jQuery)
    </script>
@endsection
