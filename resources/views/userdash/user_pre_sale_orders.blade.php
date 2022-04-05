@extends('userdash.user_dash_front')

@section('user_dash')
<div class="col-lg-9">
    <h1 class="lead display-6">Pre sale</h1>
    <div class="row">
        <div class="col col-lg-12">
            <div class="custom-container-fluid">
                <div class="product-tab-list text-center mb-35 nav" role="tablist">
                    <a class="active" href="#pickup" data-toggle="tab" role="tab" aria-selected="true">
                        <h4 style="text-transform: initial;">Pickup</h4>
                    </a>

                    <a class="" href="#delivery" data-toggle="tab" role="tab">
                        <h4 style="text-transform: initial;">Delivery</h4>
                    </a>
                </div>

                <div class="tab-content">
                    <div class="tab-pane active show fade" id="pickup" role="tabpanel">
                      
                        <div class="product-tab-list text-center mb-65 nav" role="tablist">
                            <a class="active" href="#pickup_pending" data-toggle="tab" role="tab" aria-selected="true">
                                <h4 style="text-transform: initial;">All</h4>
                            </a>

                            <a hidden class="" href="#pick_up_move_to_orders" data-toggle="tab" role="tab" >
                                <h4 style="text-transform: initial;">Move to orders</h4>
                            </a>
                        </div>


                        <div class="tab-content">
                            <div class="tab-pane active show fade" id="pickup_pending" role="tabpanel">
                            @php
                            $pre_sale_entities = App\PreOrderModel::where('is_pick_up',
                            'yes')->where('pre_order_status', 'pending')->where('customer_user_id', Auth::user()->id)->get();
                        @endphp
                            @foreach($pre_sale_entities as $pre_sale_entity)
                            @include('userdash.user_presale_conponents')
                        @endforeach
                            </div>
                            <div class="tab-pane active show fade" id="pick_up_move_to_orders" role="tabpanel">
                            @php
                            $pre_sale_entities = App\PreOrderModel::where('is_pick_up',
                            'yes')->where('pre_order_status', 'move_to_orders')->where('customer_user_id', Auth::user()->id)->get();
                             @endphp
                            @foreach($pre_sale_entities as $pre_sale_entity)
                            @include('userdash.user_presale_conponents')
                        @endforeach
                            </div>
                        </div>
                       
                    </div>

                    <div class="tab-pane fade" id="delivery" role="tabpanel">
                      

                        <div class="product-tab-list text-center mb-65 nav" role="tablist">
                            <a class="active" href="#delivery_pending" data-toggle="tab" role="tab" aria-selected="true">
                                <h4 style="text-transform: initial;">All</h4>
                            </a>

                            <a hidden class="" href="#delivery_move_to_orders" data-toggle="tab" role="tab">
                                <h4 style="text-transform: initial;">Move to orders</h4>
                            </a>
                        </div>

                        <div class="tab-content">
                            <div class="tab-pane active show fade" id="delivery_pending" role="tabpanel">
                            @php
                        $pre_sale_entities = App\PreOrderModel::where('is_pick_up','!=',
                            'yes')->where('pre_order_status', 'pending')->where('customer_user_id', Auth::user()->id)->get();
                        @endphp
                        @foreach($pre_sale_entities as $pre_sale_entity)
                            @include('userdash.user_presale_conponents')
                        @endforeach
                            </div>

                            <div class="tab-pane active show fade" id="delivery_move_to_orders" role="tabpanel">
                            @php
                        $pre_sale_entities = App\PreOrderModel::where('is_pick_up','!=',
                            'yes')->where('pre_order_status', 'move_to_orders')->where('customer_user_id', Auth::user()->id)->get();
                        @endphp
                        @foreach($pre_sale_entities as $pre_sale_entity)
                            @include('userdash.user_presale_conponents')
                        @endforeach
                            </div>
                        </div>

                    </div>

                </div>
            </div>


        </div>
    </div>
</div>
@endsection