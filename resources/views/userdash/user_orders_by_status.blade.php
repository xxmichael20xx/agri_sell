<style>
    .product-tab-list a {
        line-height: 1;
        margin: 0 12px;
    }
</style>
<div class="custom-container-fluid">
    <div class="product-tab-list text-center mb-65 nav" role="tablist">
        <a class="active" href="#to_pay-delivery" data-toggle="tab" role="tab" aria-selected="true">
            <h4 style="text-transform: initial;">Pending</h4>
        </a>

        <a href="#confirmed-delivery" data-toggle="tab" role="tab" aria-selected="true">
            <h4 style="text-transform: initial;">Confirmed</h4>
        </a>

       <a class="" href="#to_ship-delivery" data-toggle="tab" role="tab" >
            <h4 style="text-transform: initial;">To ship</h4>
        </a>

        <a class="" href="#to_receive-delivery" data-toggle="tab" role="tab" aria-selected="false">
            <h4 style="text-transform: initial;">To receive</h4>
        </a>

        <a class="" href="#to_rate-delivery" data-toggle="tab" role="tab" aria-selected="false">
            <h4 style="text-transform: initial;">To rate</h4>
        </a>

        <a class="" href="#cancelled-delivery" data-toggle="tab" role="tab" aria-selected="false">
            <h4 style="text-transform: initial;">Cancelled</h4>
        </a>
    </div>


    <div class="tab-content">
        <div class="tab-pane active show fade" id="to_pay-delivery" role="tabpanel">
            @php
                $status_id = '1';
            @endphp
            @include('userdash.order_by_status.order_cards')
        </div>
        <div class="tab-pane fade" id="confirmed-delivery" role="tabpanel">
            @php
                $status_id = '2';
            @endphp
            @include('userdash.order_by_status.order_cards')
        </div>
        <div class="tab-pane fade" id="to_ship-delivery" role="tabpanel">
            @php
                $status_id = '3';
            @endphp
            @include('userdash.order_by_status.order_cards')
        </div>
        <div class="tab-pane fade" id="to_receive-delivery" role="tabpanel">
            @php
                $status_id = '4';
            @endphp
            @include('userdash.order_by_status.order_cards')
        </div>
        <div class="tab-pane fade" id="to_rate-delivery" role="tabpanel">
            @php
                $status_id = '5';
            @endphp
            @include('userdash.order_by_status.order_cards')
        </div>
        <div class="tab-pane fade" id="cancelled-delivery" role="tabpanel">
            @php
                $status_id = '7';
            @endphp
            @include('userdash.order_by_status.order_cards')
        </div>
    </div>
</div>