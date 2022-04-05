@extends('sellerPanel.front')
@section('content')
    <div class="content">
        <a href="/sellerpanel/products" class="btn btn-outline-dark btn-round m-1 mb-2">Go back</a>
        <div class="row">
            <div class="col col-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Add new products</h4>
                    </div>
                    <!-- add new product selector -->
                    <ul class="nav nav-pills nav-pills-primary nav-pills-icons justify-content-center" role="tablist">
                        <li class="nav-item">
                        <a class="nav-link active" href="/sellerpanel/add_new_product/regular" role="tablist">
                        <i class="now-ui-icons objects_umbrella-13"></i>
                        Add Regular product 
                        </a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="/sellerpanel/add_new_product/productVariation" role="tablist">
                        <i class="now-ui-icons shopping_shop"></i>
                        Add Product Variation
                        </a>
                        </li>
                    </ul>
                    <div class="tab-content tab-space tab-subcategories">
                        <div class="tab-pane active" id="link7">
                            <div class="container">
                                <div class="row">
                                        @include('sellerPanel.products.display_product_regular_form')
                                </div>
                            </div>
                        </div>
                    <div class="tab-pane" id="link8">
                        <div class="container">
                            <div class="row">

                            </div>
                        </div>
                    </div>
                    </div>
                <!-- end of product new selector -->
                   
                </div>
            </div>
        </div>
    </div>
 
@endsection




