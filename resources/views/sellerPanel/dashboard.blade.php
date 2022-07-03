@extends('sellerPanel.front')
@section('content')
@php
    $inc = [
        'csv_url' => '/export/csv/seller/products/history/current',
        'pdf_url' => '/export/pdf/seller/products/orders/monthly',
        'key' => rand( 50, 1000 ),
        'is_seller' => true
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
                                $reportsCsv = [
                                    'key' => 'products--csv-' . rand( 50, 1000 ),
                                    'dropLabel' => 'CSV',
                                    'modalTitle' => 'CSV - Reports options',
                                    'reports' => [
                                        [
                                            'url' => '/export/csv/seller/products/list/full',
                                            'label' => 'Products List'
                                        ],
                                        [
                                            'url' => '/export/csv/seller/products/history/full',
                                            'label' => 'Orders Full'
                                        ],
                                        [
                                            'url' => '/export/csv/seller/products/orders/monthly',
                                            'label' => 'Monthly Sale'
                                        ],
                                    ]
                                ];

                                $reportsPdf = [
                                    'key' => 'products--pdf-' . rand( 50, 1000 ),
                                    'dropLabel' => 'PDF',
                                    'modalTitle' => 'PDF - Reports options',
                                    'reports' => [
                                        [
                                            'url' => '/export/pdf/seller/products/list/full',
                                            'label' => 'Products List'
                                        ],
                                        [
                                            'url' => '/export/pdf/seller/products/history/full',
                                            'label' => 'Orders Full'
                                        ],
                                        [
                                            'url' => '/export/pdf/seller/products/orders/monthly',
                                            'label' => 'Monthly Sale'
                                        ],
                                    ]
                                ];
                            @endphp
                            {{-- <a class="dropdown-item" href="/export/csv/seller/products/list/full" target="_blank">CSV - Products List</a>
                            <a class="dropdown-item" href="/export/csv/seller/products/history/full" target="_blank">CSV - Orders Full</a>
                            <a class="dropdown-item" href="/export/csv/seller/products/orders/monthly" target="_blank">CSV - Monthly Sale</a>
                            <div class="dropdown-divider m-y-2"></div>
                            <a class="dropdown-item" href="/export/pdf/seller/products/list/full" target="_blank">PDF - Products List</a>
                            <a class="dropdown-item" href="/export/pdf/seller/products/history/full" target="_blank">PDF - Orders Full</a>
                            <a class="dropdown-item" href="/export/pdf/seller/products/history/current" target="_blank">PDF - Orders Current Month</a> --}}
                            @include( 'admin.export.modal_trigger', $reportsCsv )
                            @include( 'admin.export.modal_trigger', $reportsPdf )
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
@include( 'admin.export.modal_content', $reportsCsv )
@include( 'admin.export.modal_content', $reportsPdf )
@include( 'admin.export.months_modal', $inc )
@endsection