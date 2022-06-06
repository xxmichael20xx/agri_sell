@extends('userdash.user_dash_front')
@section('user_dash')
    <div class="col-lg-9">
        <h1 class="lead display-6">My refund requests</h1>
        @foreach ($refund_requests as $refund_req)
            @php
                $status = App\prod_refund_statuses::find( $refund_req->prod_refund_status_id );
            @endphp
            <div class="row">
                <div class="col col-lg-12">
                    <div class="card border-0 shadow-lg">
                        <div class="card-header">
                            {{ $refund_req->refund_ref_id }}
                        </div>
                        <div class="card-body">
                            Product name: {!! $refund_req->product->name !!}<br>
                            Product quantity: {!! $refund_req->order_item->quantity !!}<br>
                            Refundable amount: {!! $refund_req->order_item->price * $refund_req->order_item->quantity !!}<br>
                            Refund status: {{ $status->slug ?? '' }}<br>
                            <br>
                            <p class="text-muted font-weight-bold">Note: 50% OF THE REFUND AMOUNT WILL BE DEDUCTED FROM THE SUBTOTAL OF EACH ORDER ITEM.</p>
                        </div>
                        <div class="card-footer">
                            {{ $refund_req->created_at }}
                        </div>
                
                    </div>
                </div>
            </div>

        @endforeach
    </div>
@endsection
