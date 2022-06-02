@extends('admin.front')
@section('content')
<style>
    .dashed-border {
        border-style: dashed !important;
    }
</style>
<div class="content">
    <a href="/admin/refund_management" class="btn btn-outline-dark btn-round mb-4">Go back</a>

    <div class="row">
        <div class="col-12 col-md-7">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Refund request: {{ ucfirst( $refund_request->product->name ) }}</h5>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-12 mb-4">
                            <div class="refund--images">
                                @foreach ( $refund_request->expl_images as $image)
                                    <img src="/storage/{{ $image }}" class="img-fluid w-50">
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12 mb-3 mt-3">
                            <span class="text-muted font-weight-bold">Customer details</span>
                        </div>
                        <div class="col-12 mb-3">
                            <span class="text-dark">Name: 
                                <a href="/admin/manage_user/{{ $refund_request->customer->id }}" target="_blank" class="text-decoration-none">{{ $refund_request->customer->name }}</a>
                                <i class="fa fa-info-circle text-primary" data-toggle="tooltip" data-placement="top" title="Click on name to view more details"></i>
                            </span>
                        </div>
                        <div class="col-12 mb-3">
                            <span class="text-dark">Contact Number:  {{ $refund_request->customer->mobile }}</span>
                        </div>
                        <div class="col-12 my-3">
                            <span class="text-muted font-weight-bold">Refund details: ID {{ $refund_request->refund_ref_id }}</span>
                        </div>
                        <div class="col-12 mb-3">
                            <span class="text-dark">Reason: {{ $refund_request->refund_reason_prod_txt }}</span>
                        </div>
                        <div class="col-12 mb-3">
                            <span class="text-dark">Shop: 
                                <a href="/admin/manage_shop/{{ $refund_request->product->shop->id }}" target="_blank" class="text-decoration-none">{{ $refund_request->product->shop->name }}</a>
                                <i class="fa fa-info-circle text-primary" data-toggle="tooltip" data-placement="top" title="Click on name to view more details"></i>
                            </span>
                        </div>
                        <div class="col-12 mb-3">
                            <span class="text-dark">Product: {{ $refund_request->product->name }}</span>
                        </div>
                        <div class="col-12 mb-3">
                            <span class="text-dark">Quantity: {{ AppHelpers::numeric( $refund_request->order_item->quantity ) }}</span>
                        </div>
                        <div class="col-12 mb-3">
                            <span class="text-dark">Variation: {{ $refund_request->order_item->product_variation->variation_name }}</span>
                        </div>
                        <div class="col-12 mb-3">
                            <span class="text-dark">Refundable amount: ₱ {{ AppHelpers::numeric( $refund_request->order_item->price * $refund_request->order_item->quantity ) }}</span>
                        </div>
                        <div class="col-12 mb-3">
                            <span class="text-dark">Date & Time: {{ AppHelpers::humanDate( $refund_request->created_at ) }}</span>
                        </div>
                    </div>
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

            })
        })(jQuery)
    </script>
@endsection
