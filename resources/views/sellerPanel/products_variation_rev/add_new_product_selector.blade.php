    
    <ul class="nav nav-pills nav-pills-primary nav-pills-icons justify-content-center" role="tablist">
    <li class="nav-item">
    <a class="nav-link active" data-toggle="tab" href="#link7" role="tablist">
    <i class="now-ui-icons objects_umbrella-13"></i>
    Add Regular product 
    </a>
    </li>
    <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#link8" role="tablist">
    <i class="now-ui-icons shopping_shop"></i>
    Add Product Variation
    </a>
    </li>
    
    </ul>
    <div class="tab-content tab-space tab-subcategories">
    <div class="tab-pane active" id="link7">
    <div class="container">
    <div class="row">
        <form method="POST" enctype="multipart/form-data" action="{{ route('add_new_product')}}">
                        @csrf
                        @method('POST')
                        @include('sellerPanel.products.add_new_regular_product')
        </form>
    </div>
    </div>
    </div>
    <div class="tab-pane" id="link8">
    <div class="container">
    <div class="row">
    <form method="POST" enctype="multipart/form-data" action="{{ route('add_new_product')}}">
    @csrf
    @method('POST')
    @include('sellerPanel.products.add_new_product_variations')
    </form>
    </div>
    </div>
    </div>
    </div>