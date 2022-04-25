@extends('sellerPanel.front')
@section('content')
    <div class="content">
        <a href="/sellerpanel/products" class="btn btn-outline-dark btn-round m-1 mb-2">Go back</a>
        <div class="row">
            <div class="col col-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Add new product</h4>
                    </div>
                    <div class="container">
                        <div class="row">
                            @include( 'sellerPanel.products.display_product_regular_form' )
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
