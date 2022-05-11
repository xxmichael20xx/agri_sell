@extends('admin.front')
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
                            <a class="nav-link font-weight-bold {{ isset( $pickupSection ) ? $pickupSection : 'active' }}" href="/admin/manage_orders/pickup/1">Pick up</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link font-weight-bold {{ isset( $deliverySection ) ? $deliverySection : '' }}" href="/admin/manage_orders/delivery/1">Delivery</a>
                        </li> 
                    </ul>
                </div>
            </div>
            <div id="my-tab-content" class="tab-content">
                <div class="tab-pane {{ isset( $pickupSection ) ? $pickupSection : 'active' }}" id="Pickup" role="tabpanel" aria-expanded="false">
                    <div class="col-md-12">
                        @include('admin.order_mgmt.index_subcat_parent_pickup')
                    </div>
                </div>
                <div class="tab-pane {{ isset( $deliverySection ) ? $deliverySection : 'active' }}" id="Delivery" role="tabpanel" aria-expanded="false">
                    <div class="col-md-12">
                    @include('admin.order_mgmt.index_subcat_parent_delivery')
                    </div>
                </div>
            </div>

        </div>
    </div>
    @include('admin.order_mgmt.index_stock_table')
</div>
@endsection

@section('admin.custom_scripts')
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