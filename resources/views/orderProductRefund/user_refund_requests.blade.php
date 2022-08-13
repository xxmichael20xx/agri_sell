@extends('userdash.user_dash_front')
@section('user_dash')
    <div class="col-lg-9">
        <h1 class="lead display-6">My refund requests</h1>
        @foreach ($refund_requests as $refund_req)
            @php
                $status = App\prod_refund_statuses::find( $refund_req->prod_refund_status_id );
                $amount = $refund_req->order_item->price * $refund_req->order_item->quantity;
            @endphp
            <div class="row">
                <div class="col col-lg-12">
                    <div class="card border-0 shadow-lg">
                        <div class="card-header">
                            {{ $refund_req->refund_ref_id }}
                        </div>
                        <div class="card-body">
                            <b>Product name:</b> {!! $refund_req->product->name !!}<br>
                            <b>Product quantity:</b> {!! AppHelpers::numeric( $refund_req->order_item->quantity ) !!}<br>
                            <b>Refundable amount:</b> ₱ {!! AppHelpers::numeric( $amount ) !!}<br>
                            <b>Refund status:</b> {{ $status->slug ?? '' }}<br>
                            <b>Confirmed Refundable amount:</b> ₱ {{ AppHelpers::numeric( $amount / 2 ) }}
                            <br>
                            <b>Date requested:</b> {{ AppHelpers::humanDate( $refund_req->created_at, true ) }}
                            <p class="text-muted font-weight-bold mb-0">Note: 50% OF THE REFUND AMOUNT WILL BE DEDUCTED FROM THE SUBTOTAL OF EACH ORDER ITEM.</p>
                        </div>
                    </div>
                </div>
            </div>

        @endforeach
    </div>
@endsection
