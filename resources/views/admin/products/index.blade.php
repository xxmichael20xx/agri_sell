@extends('admin.front')
@section('content')
    <div class="content">
        <div class="form-group row">
            <div class="col-md-12">
                <div class="nav-tabs-navigation">
                    <div class="nav-tabs-wrapper">
                        <ul id="tabs" class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#crops" role="tab"
                                    aria-expanded="true">Crops</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#vegetables" role="tab"
                                    aria-expanded="false">Vegetables</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#fruits" role="tab"
                                    aria-expanded="false">Fruits</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#livestocks" role="tab"
                                    aria-expanded="false">Livestocks</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#seeds" role="tab"
                                    aria-expanded="false">Seeds</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#grains" role="tab"
                                    aria-expanded="false">Grains</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div id="my-tab-content" class="tab-content">
                    <div class="tab-pane active" id="crops" role="tabpanel" aria-expanded="true">
                        <div class="col-md-12">
                            @php
                                $category_id = '1';
                                $category_name = 'Crops';
                            @endphp
                            @include('admin.products.index_subcat')
                        </div>
                    </div>
                    <div class="tab-pane" id="vegetables" role="tabpanel" aria-expanded="false">
                        <div class="col-md-12">
                            @php
                                $category_id = '2';
                                $category_name = 'Vegetables';
                            @endphp
                            @include('admin.products.index_subcat')
                        </div>
                    </div>
                    <div class="tab-pane" id="fruits" role="tabpanel" aria-expanded="false">
                        <div class="col-md-12">
                            @php
                                $category_id = '3';
                                $category_name = 'Fruits';
                            @endphp
                            @include('admin.products.index_subcat')
                        </div>
                    </div>

                    <div class="tab-pane" id="livestocks" role="tabpanel" aria-expanded="false">
                        <div class="col-md-12">
                            @php
                                $category_id = '4';
                                $category_name = 'Livestocks';
                            @endphp
                            @include('admin.products.index_subcat')
                        </div>
                    </div>

                    <div class="tab-pane" id="seeds" role="tabpanel" aria-expanded="false">
                        <div class="col-md-12">
                            @php
                                $category_id = '5';
                                $category_name = 'Seeds';
                            @endphp
                            @include('admin.products.index_subcat')
                        </div>
                    </div>

                    <div class="tab-pane" id="grains" role="tabpanel" aria-expanded="false">
                        <div class="col-md-12">
                            @php
                                $category_id = '6';
                                $category_name = 'Grains';
                            @endphp
                            @include('admin.products.index_subcat')
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="nav-tabs-navigation">
                            <div class="nav-tabs-wrapper">
                                <ul id="tabsChart" class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#allChart" role="tab"
                                            aria-expanded="true">General</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#cropsChart" role="tab"
                                            aria-expanded="true">Crops</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#vegetablesChart" role="tab"
                                            aria-expanded="false">Vegetables</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#fruitsChart" role="tab"
                                            aria-expanded="false">Fruits</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#livestocksChart" role="tab"
                                            aria-expanded="false">Livestocks</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#seedsChart" role="tab"
                                            aria-expanded="false">Seeds</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#grainsChart" role="tab"
                                            aria-expanded="false">Grains</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div id="my-tab-content-chart" class="tab-content">
                            <div class="tab-pane active" id="allChart" role="tabpanel" aria-expanded="true">
                                <div class="col-12 mb-2">
                                    <h5 class="card-title font-weight-bold">Top 10 Products: All</h5>
                                </div>
                                <div class="col-md-12">
                                    @php
                                        $category_id = 'all';
                                        $category_name = 'All';
                                    @endphp
                                    @include('admin.products.top_products')
                                </div>
                            </div>
                            <div class="tab-pane" id="cropsChart" role="tabpanel" aria-expanded="true">
                                <div class="col-12 mb-2">
                                    <h5 class="card-title font-weight-bold">Top 10 Products: Crops</h5>
                                </div>
                                <div class="col-md-12">
                                    @php
                                        $category_id = '1';
                                        $category_name = 'Crops';
                                    @endphp
                                    @include('admin.products.top_products')
                                </div>
                            </div>
                            <div class="tab-pane" id="vegetablesChart" role="tabpanel" aria-expanded="false">
                                <div class="col-12 mb-2">
                                    <h5 class="card-title font-weight-bold">Top 10 Products: Vegetables</h5>
                                </div>
                                <div class="col-md-12">
                                    @php
                                        $category_id = '2';
                                        $category_name = 'Vegetables';
                                    @endphp
                                    @include('admin.products.top_products')
                                </div>
                            </div>
                            <div class="tab-pane" id="fruitsChart" role="tabpanel" aria-expanded="false">
                                <div class="col-12 mb-2">
                                    <h5 class="card-title font-weight-bold">Top 10 Products: Fruits</h5>
                                </div>
                                <div class="col-md-12">
                                    @php
                                        $category_id = '3';
                                        $category_name = 'Fruits';
                                    @endphp
                                    @include('admin.products.top_products')
                                </div>
                            </div>
    
                            <div class="tab-pane" id="livestocksChart" role="tabpanel" aria-expanded="false">
                                <div class="col-12 mb-2">
                                    <h5 class="card-title font-weight-bold">Top 10 Products: Livestocks</h5>
                                </div>
                                <div class="col-md-12">
                                    @php
                                        $category_id = '4';
                                        $category_name = 'Livestocks';
                                    @endphp
                                    @include('admin.products.top_products')
                                </div>
                            </div>
    
                            <div class="tab-pane" id="seedsChart" role="tabpanel" aria-expanded="false">
                                <div class="col-12 mb-2">
                                    <h5 class="card-title font-weight-bold">Top 10 Products: Seeds</h5>
                                </div>
                                <div class="col-md-12">
                                    @php
                                        $category_id = '5';
                                        $category_name = 'Seeds';
                                    @endphp
                                    @include('admin.products.top_products')
                                </div>
                            </div>
    
                            <div class="tab-pane" id="grainsChart" role="tabpanel" aria-expanded="false">
                                <div class="col-12 mb-2">
                                    <h5 class="card-title font-weight-bold">Top 10 Products: Grains</h5>
                                </div>
                                <div class="col-md-12">
                                    @php
                                        $category_id = '6';
                                        $category_name = 'Grains';
                                    @endphp
                                    @include('admin.products.top_products')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
