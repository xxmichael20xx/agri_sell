@extends('sellerPanel.front')
@section('content')
<div class="content">
        <div class="row">
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
                        $products = App\Product::where( [ 'category_id' => $category_id, 'product_user_id' => Auth::user()->id ])->get();
                        @endphp
                        @include('sellerPanel.products.index_subcat')
                    </div>
                </div>
                <div class="tab-pane" id="vegetables" role="tabpanel" aria-expanded="false">
                <div class="col-md-12">
                        @php
                        $category_id = '2';
                        $category_name = 'Vegetables';
                        $products = App\Product::where( [ 'category_id' => $category_id, 'product_user_id' => Auth::user()->id ])->get();
                        @endphp
                        @include('sellerPanel.products.index_subcat')
                    </div>
                </div>
                <div class="tab-pane" id="fruits" role="tabpanel" aria-expanded="false">
                  <div class="col-md-12">
                        @php
                        $category_id = '3';
                        $category_name = 'Fruits';
                        $products = App\Product::where( [ 'category_id' => $category_id, 'product_user_id' => Auth::user()->id ])->get();
                        @endphp
                        @include('sellerPanel.products.index_subcat')
                    </div>
                </div>

                <div class="tab-pane" id="livestocks" role="tabpanel" aria-expanded="false">
                  <div class="col-md-12">
                        @php
                        $category_id = '4';
                        $category_name = 'Livestocks';
                        $products = App\Product::where( [ 'category_id' => $category_id, 'product_user_id' => Auth::user()->id ])->get();
                        @endphp
                        @include('sellerPanel.products.index_subcat')
                    </div>
                </div>

                <div class="tab-pane" id="seeds" role="tabpanel" aria-expanded="false">
                  <div class="col-md-12">
                        @php
                        $category_id = '5';
                        $category_name = 'Seeds';
                        $products = App\Product::where( [ 'category_id' => $category_id, 'product_user_id' => Auth::user()->id ])->get();
                        @endphp
                        @include('sellerPanel.products.index_subcat')
                    </div>
                </div>
                <div class="tab-pane" id="grains" role="tabpanel" aria-expanded="false">
                  <div class="col-md-12">
                        @php
                        $category_id = '6';
                        $category_name = 'Grains';
                        $products = App\Product::where( [ 'category_id' => $category_id, 'product_user_id' => Auth::user()->id ])->get();
                        @endphp
                        @include('sellerPanel.products.index_subcat')
                    </div>
                </div>
            </div>  
            </div>
          </div>
      </div>
@endsection
