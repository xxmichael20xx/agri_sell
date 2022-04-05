<div class="custom-container-fluid">
        <div class="product-tab-list text-center mb-65 nav" role="tablist">
            <a class="active" href="#pickup" data-toggle="tab" role="tab" aria-selected="true">
                <h4 style="text-transform: initial;">Pickup</h4>
            </a>        
            <a class="" href="#delivery" data-toggle="tab" role="tab">
                <h4 style="text-transform: initial;">Delivery</h4>
            </a>
        </div>
        <div class="tab-content">
            <div class="tab-pane active show fade" id="pickup" role="tabpanel">
            @include('userdash.users_orders_by_status_pickup')
            </div>
            
            <div class="tab-pane fade" id="delivery" role="tabpanel">
            @include('userdash.user_orders_by_status')
            </div>
        </div>
</div>