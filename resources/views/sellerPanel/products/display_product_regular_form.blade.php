        <form method="POST" enctype="multipart/form-data" action="{{ route('save_new_product_regular')}}">
                    @csrf
                    @method('POST')
                        <input type="hidden" name="shop_id" value="{{Auth::user()->shop->id}}">
                        <div class="card-body">
                        <div class="row">
                            <label class="col-md-3 col-form-label">Product name</label>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input required type="text" class="form-control" name="product_name" placeholder="">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 col-form-label">Product images</label>
                            <div class="col-md-9">
                                <script>
                                    function preview_images() {
                                        var total_file = document.getElementById("images").files.length;
                                        for (var i = 0; i < total_file; i++) {
                                            $('#image_preview').append("<div class='col-md-3'><img class='img-responsive' src='" + URL.createObjectURL(event.target.files[i]) + "'></div>");
                                        }
                                    }
                                </script>
                                <div class="col-md-12">
                                    <input type="file" class="form-control" id="images" name="images[]" onchange="preview_images();" multiple/>
                                </div>
                                <div class="row" id="image_preview"></div>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 col-form-label">Product category</label>
                            <div class="col-md-9">
                                @php
                                    $product_categories = App\Category::all();
                                @endphp
                                <select class="selectpicker w-100" data-style="btn btn-primary btn-round"
                                         title="Select product category" name="category_id" required>
                                    @foreach ($product_categories as $product_category)
                                        <option value="{{$product_category->id}}">{{$product_category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div hidden class="row">
                            <label class="col-md-3 col-form-label">Variation name</label>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input type="text" class="form-control"
                                           name="variation_name" value=""
                                           placeholder="">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <label class="col-md-3 col-form-label">Price</label>
                            <div class="col-md-9">
                                <div class="form-group">
                                <ul class="nav nav-pills nav-pills-primary nav-pills-icons justify-content-center" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#retail_container" role="tablist">
                                    <i class="now-ui-icons objects_umbrella-13"></i>
                                        Retail
                                    </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#wholesale_container" role="tablist">
                                        <i class="now-ui-icons shopping_shop"></i>
                                        Wholesale
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
                                            <input  type="text" class="form-control" name="retail_price" placeholder="">
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
                                            <input type="text" class="form-control" name="wholesale_price" placeholder="">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-md-3 col-form-label">Wholesale min quantity</label>
                                    <div class="col-md-9">
                                        <div class="form-group"> 
                                            <input type="text" class="form-control" name="wholesale_min_qty" placeholder="">
                                        </div>
                                    </div>
                                </div>

                                
                                <!-- end of wholesale_container -->
                            </div>
                        </div>     
                                <div class="row">
                                    <label class="col-md-3 col-form-label">Product sold per</label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="wholesale_sold_per"> 
                                            <option value="kilo">Kilo</option>
                                            <option value="sacks">Sacks</option>
                                            <option value="box">Box</option>
                                            <option value="piece">Piece</option>
                                            <option value="kaing">Kaing</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                        <label class="col-md-3 col-form-label">Product description</label>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <textarea type="text" class="form-control" name="product_desc"></textarea>
                                                <small>(Note: Please indicate the detailed size if your product is sold per KAING or BOX)</small>
                                            </div>
                                        </div>
                                </div>

                                <div class="row">
                                    <label class="col-md-3 col-form-label">Standard net weight</label>
                                    <div class="col-md-9">
                                        <div clas="row"> 
                                            <div class="col-md-8">
                                                <input type="text" class="form-control mb-2" name="standard_net_weight" placeholder="">
                                                <select class="form-control" name="standard_net_weight_unit">
                                                    <option value="gram">Gram</option>
                                                    <option value="kilogram">Kilogram</option>
                                                </select>
                                            </div>
                                        </div>  
                                    </div>
                                </div>


                        <div class="row mt-2">
                            <label class="col-md-3 col-form-label">Stocks</label>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="stocks" placeholder="">
                                </div>
                            </div>
                        </div>

                        <div hidden class="row">
                            <label class="col-md-3 col-form-label">Sale precentage deduction</label>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input  type="number" class="form-control" name="sale_pct_deduction"
                                           value="">
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

                        <script>
                            function changeIsProductSaleStatus() {
                                var checkBoxIsProductSale = document.getElementById("switch_is_prod_sale")
                                if (checkBoxIsProductSale.checked == true) {
                                    document.getElementById('isSaleValueSetter').value = "1";
                                } else {
                                    document.getElementById('isSaleValueSetter').value = "0";
                                }
                            }
                        </script>

                        <div class="row">
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
                        
                        <script>
                            function changeIsProductPreSaleStatus() {
                                var checkBoxIsProductPreSale = document.getElementById("switch_is_prod_presale")
                                if (checkBoxIsProductPreSale.checked == true) {
                                    document.getElementById('isPreSaleValueSetter').value = "1";
                                } else {
                                    document.getElementById('isPreSaleValueSetter').value = "0";
                                }
                            }
                        </script>

                        <div class="row">
                            <label class="col-md-3 col-form-label">Product pre sale deadline</label>
                            <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" name="pre_sale_deadline"
                                                class="form-control datetimepicker">
                                                <small>(Note: Please select the date of your estimated product availability/harvest)</small>
                                    </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <input type="submit" value="save" class="btn btn-primary" />
                            </div>
                        </div>
    </div>

               
    </form>
                          
                    
      