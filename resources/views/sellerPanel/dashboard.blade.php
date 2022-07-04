@extends('sellerPanel.front')
@section('content')
@php
    $inc = [
        'type' => 'seller_dashboard',
        'csv_url' => '/export/csv/seller/products/history/current',
        'pdf_url' => '/export/pdf/seller/products/orders/monthly',
        'is_seller' => true,
        'key' => rand( 50, 1000 )
    ];
@endphp
<div class="content">
    <div class="row">
        <div class="col-lg-5 col-md-6 col-sm-12">
            <div class="card">
            <div class="image">
                    <img src="{{ asset('storage/'.Auth::user()->shop->shop_bg) }}">
                </div>
                <div class="card-body text-center">
                    <h5 class="title text-primary">{{ $shop_title }}</h5>

                    <p class="description">
                        {{ $shop_description }}
                    </p>
                </div>

            </div>
        </div>
        <div class="col-lg-7 col-md-6 col-sm-12">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-5 col-md-4">
                                    <div class="icon-big text-center icon-warning">
                                        <i class="nc-icon nc-box-2 text-primary"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-md-8">
                                    <div class="numbers">
                                        <p class="card-category">Order total count</p>
                                        <p class="card-title">{{ $shop_order_count }}<p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ">
                            <hr>
                            <div class="stats">
                                <i class="fa fa-bandcamp"></i>
                                Total orders that includes the items from your shop
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-5 col-md-4">
                                    <div class="icon-big text-center icon-warning">
                                        <i class="nc-icon nc-favourite-28 text-warning"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-md-8">
                                    <div class="numbers">
                                        <p class="card-category">Average rating</p>
                                        <p class="card-title">{{ $shopAveRating !== 'Unrated' ? $shopAveRating . " Stars" : $shopAveRating }}<p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ">
                            <hr>
                            <div class="stats">
                                <i class="fa fa-bandcamp"></i>
                                Accumulated by the average rating of your products

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-5 col-md-4">
                                    <div class="icon-big text-center icon-warning">
                                        <i class="nc-icon nc-box-2 text-danger"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-md-8">
                                    <div class="numbers">
                                        <p class="card-category">Products</p>
                                        <p class="card-title">{{ $shopProductsCount }}<p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ">
                            <hr>
                            <div class="stats">
                                <i class="fa fa-bandcamp"></i>
                                Number of products in your shop
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-5 col-md-4">
                                    <div class="icon-big text-center icon-warning">
                                        <i class="nc-icon nc-money-coins text-success"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-md-8">
                                    <div class="numbers">
                                        <p class="card-category">Available Total Sales</p>
                                        <p class="card-title">{{ $total_sales_deduction_diff }}<p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ">
                            <hr>
                            <div class="stats">
                                <i class="fa fa-bandcamp"></i>
                                Your total sales in your shop
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-12 col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4 class="card-title">Ordered products by qty</h4>
                    <div class="dropdown dropleft">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="report--activity-logs" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Report Generation
                        </button>
                        <div class="dropdown-menu">
                            @php
                                $reportProducts = [
                                    'type' => 'seller_dashboard',
                                    'key' => 'seller_dashboard-products-list',
                                    'title' => 'Products List',
                                    'reports' => [
                                        [
                                            'href' => '/export/csv/seller/products/list/full',
                                            'label' => 'CSV'
                                        ],
                                        [
                                            'href' => '/export/pdf/seller/products/list/full',
                                            'label' => 'PDF'
                                        ],
                                    ]
                                ];
                                $reportOrders = [
                                    'type' => 'seller_dashboard',
                                    'key' => 'seller_dashboard-orders-full',
                                    'title' => 'Orders Full',
                                    'reports' => [
                                        [
                                            'href' => '/export/csv/seller/products/history/full',
                                            'label' => 'CSV'
                                        ],
                                        [
                                            'href' => '/export/pdf/seller/products/history/full',
                                            'label' => 'PDF'
                                        ],
                                    ]
                                ];
                                $reportMonthlySales = [
                                    'type' => 'seller_dashboard',
                                    'key' => 'seller_dashboard-monthly-sale',
                                    'title' => 'Monthly Sale',
                                    'reports' => [
                                        [
                                            'href' => '/export/csv/seller/products/orders/monthly',
                                            'label' => 'CSV'
                                        ],
                                        [
                                            'href' => '/export/pdf/seller/products/orders/monthly',
                                            'label' => 'PDF'
                                        ],
                                    ]
                                ];
                            @endphp
                            @include( 'admin.export.modal_trigger', $inc )
                            @include( 'admin.export.months_trigger', $inc )
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @include('sellerPanel.charts.sales_by_seller')
                </div>
            </div>
        </div>
    </div>
</div>
@include( 'admin.export.modal_content', $reportProducts )
@include( 'admin.export.modal_content', $reportOrders )
@include( 'admin.export.modal_content', $reportMonthlySales )
@include( 'admin.export.months_modal', $inc )
@endsection