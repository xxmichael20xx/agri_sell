<form method="POST" enctype="multipart/form-data" action="{{ route('save_new_product_regular')}}" id="save_new_product_regular">
    @csrf
    @method('POST')
    <input type="hidden" name="shop_id" value="{{Auth::user()->shop->id}}">
    <div class="card-body">
        <div class="form-group row">
            <label class="col-md-3 col-form-label">Product name</label>
            <div class="col-md-9">
                <div class="form-group">
                    <input type="text" class="form-control" name="product_name" value="{{ old('product_name') }}">
                    @if ( $errors->has( 'product_name' ) )
                        <span class="text-danger">{{ $errors->first( 'product_name' ) }}</span>
                    @endif
                </div>
            </div>
        </div>

        <div class="row mb-2">
            <label class="col-md-3 col-form-label">Product images</label>
            <div class="col-md-9">
                <input type="file" class="form-control" id="images" name="images[]" onchange="preview_images();" multiple/>
                @if ( $errors->has( 'images' ) )
                    <span class="text-danger">{{ $errors->first( 'images' ) }}</span>
                @endif
                <div class="row" id="image_preview"></div>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-3 col-form-label">Product category</label>
            <div class="col-md-9">
                @php
                    $product_categories = App\Category::all();
                @endphp
                <select class="selectpicker w-100" data-style="btn btn-primary btn-round" title="Select product category" name="category_id">
                    @foreach ($product_categories as $product_category)
                        @php
                            $isSelected = old( 'category_id' ) == $product_category->id ? 'selected' : '';
                        @endphp
                        <option value="{{ $product_category->id }}" {{ $isSelected }}>{{ $product_category->name }}</option>
                    @endforeach
                </select>
                @if ( $errors->has( 'category_id' ) )
                    <span class="text-danger">{{ $errors->first( 'category_id' ) }}</span>
                @endif
            </div>
        </div>

        <div hidden class="form-group row">
            <label class="col-md-3 col-form-label">Variation name</label>
            <div class="col-md-9">
                <div class="form-group">
                    <input
                        type="text" 
                        class="form-control"
                        name="variation_name"
                        value=""
                        placeholder=""
                    />
                </div>
            </div>
        </div>
        
        <div class="form-group row">
            <label class="col-md-3 col-form-label">Price</label>
            <input type="hidden" id="is_wholeSale" name="is_wholeSale" value="retail">
            <div class="col-md-9">
                <div class="form-group py-2">
                    <ul class="nav nav-pills nav-pills-primary nav-pills-icons justify-content-center" data-action-type="is--retail-wholesale" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#retail_container" role="tablist" data-type="retail">
                                <i class="now-ui-icons objects_umbrella-13"></i> Retail
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#wholesale_container" role="tablist" data-type="wholesale">
                                <i class="now-ui-icons shopping_shop"></i>Wholesale
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="tab-content tab-space tab-subcategories">
            <div class="tab-pane active" id="retail_container">
                <!-- retail container -->
                <div class="row">
                    <label class="col-md-3 col-form-label">Retail price</label>
                    <div class="col-md-9">
                        <div class="form-group">
                            <input type="number" class="form-control" name="retail_price" value="{{ old( 'retail_price' ) }}">
                            @if ( $errors->has( 'retail_price' ) )
                                <span class="text-danger">{{ $errors->first( 'retail_price' ) }}</span>
                            @endif
                        </div>
                    </div>
                </div>
            <!-- end retail container -->
            </div>
            <div class="tab-pane" id="wholesale_container">
                <!-- Wholesale container-->                                    
                <div class="row">
                    <label class="col-md-3 col-form-label">Wholesale price</label>
                    <div class="col-md-9">
                        <div class="form-group"> 
                            <input type="number" class="form-control" name="wholesale_price" value="{{ old( 'wholesale_price' ) }}">
                            @if ( $errors->has( 'wholesale_price' ) )
                                <span class="text-danger">{{ $errors->first( 'wholesale_price' ) }}</span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <label class="col-md-3 col-form-label">Wholesale min quantity</label>
                    <div class="col-md-9">
                        <div class="form-group"> 
                            <input type="text" class="form-control" name="wholesale_min_qty" value="{{ old( 'wholesale_min_qty' ) }}">
                            @if ( $errors->has( 'wholesale_min_qty' ) )
                                <span class="text-danger">{{ $errors->first( 'wholesale_min_qty' ) }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- end of wholesale_container -->
            </div>
        </div>     
        <div class="form-group row">
            <label class="col-md-3 col-form-label">Product sold per</label>
            <div class="col-md-9">
                @php
                    $soldPerOptions = [ 'kilo', 'sacks', 'box', 'piece', 'kaing' ];
                @endphp
                <select class="form-control" name="wholesale_sold_per"> 
                    <option selected disabled>Select option</option>
                    @foreach ( $soldPerOptions as $soldPerOption )
                        @php
                            $isSelected = old( 'wholesale_sold_per' ) == $soldPerOption ? 'selected' : '';
                        @endphp
                        <option value="{{ $soldPerOption }}" isSelected>{{ ucfirst( $soldPerOption ) }}</option>
                    @endforeach
                </select>
                @if ( $errors->has( 'wholesale_sold_per' ) )
                    <span class="text-danger">{{ $errors->first( 'wholesale_sold_per' ) }}</span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-3 col-form-label">Product description</label>
            <div class="col-md-9">
                <div class="form-group">
                    <textarea type="text" class="form-control" name="product_desc" value="{{ old( 'product_desc' ) }}"></textarea>
                    <small>(Note: Please indicate the detailed size if your product is sold per KAING or BOX)</small>
                    @if ( $errors->has( 'product_desc' ) )
                        <span class="text-danger">{{ $errors->first( 'product_desc' ) }}</span>
                    @endif
                </div>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-3 col-form-label">Standard net weight</label>
            <div class="col-md-9">
                <input type="number" class="form-control mb-2" name="standard_net_weight" value="{{ old( 'standard_net_weight' ) }}">
                @if ( $errors->has( 'standard_net_weight' ) )
                    <span class="text-danger">{{ $errors->first( 'standard_net_weight' ) }}</span>
                @endif

                <select class="form-control" name="standard_net_weight_unit">
                    <option value="gram" {{ old( 'standard_net_weight_unit' ) == 'gram' ? 'selected': '' }}>Gram</option>
                    <option value="kilogram" {{ old( 'standard_net_weight_unit' ) == 'kilogram' ? 'selected': '' }}>Kilogram</option>
                </select>
                @if ( $errors->has( 'standard_net_weight_unit' ) )
                    <span class="text-danger">{{ $errors->first( 'standard_net_weight_unit' ) }}</span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-3 col-form-label">Stocks</label>
            <div class="col-md-9">
                <div class="form-group">
                    <input type="number" class="form-control" name="stocks" value="{{ old( 'stocks' ) }}">
                    @if ( $errors->has( 'stocks' ) )
                        <span class="text-danger">{{ $errors->first( 'stocks' ) }}</span>
                    @endif
                </div>
            </div>
        </div>

        <div hidden class="row">
            <label class="col-md-3 col-form-label">Sale precentage deduction</label>
            <div class="col-md-9">
                <div class="form-group">
                    <input type="number" class="form-control" name="sale_pct_deduction" value="{{ old( 'sale_pct_deduction' ) }}">=
                </div>
            </div>
        </div>

        <div hidden class="row">
            <label class="col-md-3 col-form-label">Sale</label>
            <div class="col-md-4">
                <input class="bootstrap-switch" type="checkbox" onchange="changeIsProductSaleStatus()"
                        id="switch_is_prod_sale" data-toggle="switch"
                        data-on-label="<i class='nc-icon nc-check-2'></i>"
                        data-off-label="<i class='nc-icon nc-simple-remove'></i>" data-on-color="success"
                        data-off-color="success" />
                <input type="hidden" id="isSaleValueSetter" name="is_Sale">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-3 col-form-label">Pre sale</label>
            <div class="col-md-4">

                <input class="bootstrap-switch" type="checkbox" onchange="changeIsProductPreSaleStatus()"
                        id="switch_is_prod_presale" data-toggle="switch"
                        data-on-label="<i class='nc-icon nc-check-2'></i>"
                        data-off-label="<i class='nc-icon nc-simple-remove'></i>" data-on-color="success"
                        data-off-color="success" />
                <input  type="hidden" id="isPreSaleValueSetter" name="is_preSale">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-3 col-form-label">Product pre sale deadline</label>
            <div class="col-md-4">
                <div class="form-group">
                    <input type="text" name="pre_sale_deadline" class="form-control datetimepicker" value="{{ old( 'pre_sale_deadline' ) }}">
                    <small>(Note: Please select the date of your estimated product availability/harvest)</small>
                    @if ( $errors->has( 'pre_sale_deadline' ) )
                        <span class="text-danger">{{ $errors->first( 'pre_sale_deadline' ) }}</span>
                    @endif
                </div>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-12">
                <input type="submit" value="save" class="btn btn-primary" />
            </div>
        </div>
    </div>  
</form>


<script>
    window.onload = () => {
        $( document ).on( 'click', '[data-action-type="is--retail-wholesale"] li a', function() {
            const type = $( this ).data( 'type' )
            $( '#is_wholeSale' ).val( type )
        } )
    }

    function preview_images() {
        var total_file = document.getElementById("images").files.length;
        for (var i = 0; i < total_file; i++) {
            $('#image_preview').append("<div class='col-md-3'><img class='img-responsive' src='" + URL.createObjectURL(event.target.files[i]) + "'></div>");
        }
    }

    function changeIsProductSaleStatus() {
        var checkBoxIsProductSale = document.getElementById("switch_is_prod_sale")
        if (checkBoxIsProductSale.checked == true) {
            document.getElementById('isSaleValueSetter').value = "1";
        } else {
            document.getElementById('isSaleValueSetter').value = "0";
        }
    }

    function changeIsProductPreSaleStatus() {
        var checkBoxIsProductPreSale = document.getElementById("switch_is_prod_presale")
        if (checkBoxIsProductPreSale.checked == true) {
            document.getElementById('isPreSaleValueSetter').value = "1";
        } else {
            document.getElementById('isPreSaleValueSetter').value = "0";
        }
    }
</script>