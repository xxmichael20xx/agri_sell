@extends('sellerPanel.front')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-navigation">
                <div class="nav-tabs-wrapper">
                    <ul id="tabs" class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link " data-toggle="tab" href="#Pickup" role="tab"
                                aria-expanded="false">Pick up</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" data-toggle="tab" href="#Delivery" role="tab" aria-expanded="">Delivery</a>
                        </li> 
                    </ul>
                </div>
            </div>
            <div id="my-tab-content" class="tab-content">
                <div class="tab-pane active" id="Pickup" role="tabpanel" aria-expanded="false">
                    <div class="col-md-12">
                        @include('sellerPanel.orders.index_subcat_parent_pickup')
                    </div>
                </div>
                <div class="tab-pane" id="Delivery" role="tabpanel" aria-expanded="false">
                    <div class="col-md-12">
                    @include('sellerPanel.orders.index_subcat_parent_delivery')
                    </div>
                </div>
               
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-12">
            @include('sellerPanel.orders.index_stock_table')
        </div>
    </div>
</div>
@endsection