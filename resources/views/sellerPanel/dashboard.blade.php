@extends('sellerPanel.front')
@section('content')

<!-- // shop_title
// shop_description
// shop_order_count
// shopAveRating
// total_sales_deduction_diff -->
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
                                        <p class="card-title">{{ $shopAveRating }}<p>
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
                <div class="card-header">
                    Ordered products by qty
                </div>
                <div class="card-body">
                    @include('sellerPanel.charts.sales_by_seller')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
