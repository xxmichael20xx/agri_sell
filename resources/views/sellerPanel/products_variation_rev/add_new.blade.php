@extends('sellerPanel.front')
@section('content')

    <div class="content">
        <a href="/sellerpanel/products" class="btn btn-outline-dark btn-round m-1 mb-2">Go back</a>
        <div class="row">
            <div class="col col-12 col-lg-9">
                <div class="card">
                  
                    <div class="card-header">
                        <h4>Add new products</h4>
                    </div>
                    @include('sellerPanel.products.add_new_product_selector')
                    <div class="card-footer">
                        <button class="btn btn-warning btn-round" form="addProduct">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
 
@endsection
