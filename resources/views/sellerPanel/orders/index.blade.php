@extends('sellerPanel.front')
@section('content')
@php
    if ( isset( $category_type ) ) {
        $pickupSection = $category_type == 'pickup' ? 'active show' : '';
        $deliverySection = $category_type == 'delivery' ? 'active show' : '';
    }
@endphp
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-navigation">
                <div class="nav-tabs-wrapper">
                    <ul id="tabs" class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link font-weight-bold {{ isset( $pickupSection ) ? $pickupSection : 'active' }}" href="/sellerpanel/manage_orders/pickup/1">
                                Pick up
                                <span class="badge badge-info">{{ $pendingPickup }}</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link font-weight-bold {{ isset( $deliverySection ) ? $deliverySection : '' }}" href="/sellerpanel/manage_orders/delivery/1">
                                Delivery
                                <span class="badge badge-info">{{ $pendingDelivery }}</span>
                            </a>
                        </li> 
                    </ul>
                </div>
            </div>
            <div id="my-tab-content" class="tab-content">
                <div class="tab-pane {{ isset( $pickupSection ) ? $pickupSection : 'active' }}" id="Pickup" role="tabpanel" aria-expanded="false">
                    <div class="col-md-12">
                        @include('sellerPanel.orders.index_subcat_parent_pickup')
                    </div>
                </div>
                <div class="tab-pane {{ isset( $deliverySection ) ? $deliverySection : 'active' }}" id="Delivery" role="tabpanel" aria-expanded="false">
                    <div class="col-md-12">
                        @include('sellerPanel.orders.index_subcat_parent_delivery')
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('sellerPanel.orders.index_stock_table')
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
            })
        })(jQuery)
    </script>
@endsection