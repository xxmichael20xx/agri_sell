{{--order by status pickup only--}}
<style>
    .product-tab-list a {
        line-height: 1;
        margin: 0 12px;
    }
</style>
<div class="custom-container-fluid">
    <div class="product-tab-list text-center mb-65 nav" role="tablist">
        <a class="active" href="#pending" data-toggle="tab" role="tab" aria-selected="true">
            <h4 style="text-transform: initial;">Pending</h4>
        </a>

        <a class="" href="#confirmed" data-toggle="tab" role="tab">
            <h4 style="text-transform: initial;">Confirmed</h4>
        </a>

        <a class="" href="#ready_to_pickup" data-toggle="tab" role="tab">
            <h4 style="text-transform: initial;">Ready to pickup</h4>
        </a>

        <a class="" href="#pickup_to_rate" data-toggle="tab" role="tab">
            <h4 style="text-transform: initial;">To rate</h4>
        </a>

        <a class="" href="#cancelled" data-toggle="tab" role="tab">
            <h4 style="text-transform: initial;">Cancelled</h4>
        </a>
    </div>

    <div class="tab-content">
        <div class="tab-pane active show fade" id="pending" role="tabpanel">
            <div class="row">
                @php
                    $status_id = '8';
                    $pickup_status_id = '1';
                @endphp
                @include('userdash.order_by_status.pickup_order_status_cards')
            </div>
        </div>
        <div class="tab-pane fade" id="confirmed" role="tabpanel">
            <div class="row">
                @php
                    $status_id = '2';
                    $pickup_status_id = '6';
                @endphp
                @include('userdash.order_by_status.pickup_order_status_cards')
            </div>
        </div>
        <div class="tab-pane fade" id="ready_to_pickup" role="tabpanel">
            @php
                $status_id = '8';
                $pickup_status_id = '2';
            @endphp
            @include('userdash.order_by_status.pickup_order_status_cards')
        </div>
        <div class="tab-pane fade" id="cancelled" role="tabpanel">
            @php
                $status_id = '8';
                $pickup_status_id = '2';
            @endphp
            @include('userdash.order_by_status.pickup_order_status_cards')
        </div>
        <div class="tab-pane fade" id="pickup_to_rate" role="tabpanel">
            @php
                $status_id = '8';
                $pickup_status_id = '5';
            @endphp
            @include('userdash.order_by_status.pickup_order_status_cards')
        </div>
        <div class="tab-pane fade" id="cancelled" role="tabpanel">
            @php
                $status_id = '8';
                $pickup_status_id = '3';
            @endphp
            @include('userdash.order_by_status.pickup_order_status_cards')
        </div>
    </div>
</div>