@php
    $basePickupView = "sellerPanel.orders.tables.pickup.";
    $baseDeliveryView = "sellerPanel.orders.tables.delivery.";
@endphp

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                @if ( isset( $status_obj ) && isset( $is_pick_up ) )
                    <h4 class="card-title">{{ $status_obj->display_name }}</h4>
                @endif
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    @if ( $category_type == 'pickup' )
                        @includeWhen( $status_id == 1, $basePickupView . "pending" )
                        @includeWhen( $status_id == 2, $basePickupView . "pickup" )
                        @includeWhen( $status_id == 3, $basePickupView . "cancelled" )
                        @includeWhen( $status_id == 5, $basePickupView . "completed" )
                        @includeWhen( $status_id == 6, $basePickupView . "confirmed" )
                    @else
                        @includeWhen( $status_id == 1, $baseDeliveryView . "pending" )
                        @includeWhen( $status_id == 2, $baseDeliveryView . "confirmed" )
                        @includeWhen( $status_id == 3, $baseDeliveryView . "picked_up" )
                        @includeWhen( $status_id == 4, $baseDeliveryView . "on_delivery" )
                        @includeWhen( $status_id == 5, $baseDeliveryView . "completed" )
                        @includeWhen( $status_id == 6, $baseDeliveryView . "deliver_failed" )
                        @includeWhen( $status_id == 7, $baseDeliveryView . "cancelled" )
                        @includeWhen( $status_id == 9, $baseDeliveryView . "ready" )
                    @endif
                </div>
            </div>
        </div>
    </div>