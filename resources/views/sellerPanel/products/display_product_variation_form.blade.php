<form method="POST" enctype="multipart/form-data" action="{{ route('save_new_product_variation')}}">
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
                        
                        <div class="row">
                            <label class="col-md-3 col-form-label">Product description</label>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <textarea type="text" class="form-control" 
                                              name="product_desc"></textarea>
                                </div>
                            </div>
                        </div>
                        
<div class="row">
        <div class="col-md-12 col-12">
        @include('sellerPanel.products.multi_field_prodsVars')

</div>
</div>    

<div class="row">
<div class="field_wrapper">
    <div class="col-md-12">
        <a href="javascript:void(0);" class="add_button btn btn-primary" title="Add field">Add new</a>

    </div>
</div>
</div>

                        <div class="row">
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

                        <div class="row" hidden>
                            <label class="col-md-3 col-form-label">Pre sale</label>
                            <div class="col-md-4">

                                <input class="bootstrap-switch" type="checkbox" onchange="changeIsProductPreSaleStatus()"
                                       id="switch_is_prod_presale" data-toggle="switch"
                                       data-on-label="<i class='nc-icon nc-check-2'></i>"
                                       data-off-label="<i class='nc-icon nc-simple-remove'></i>" data-on-color="success"
                                       data-off-color="success" />
                                <input type="hidden" id="isPreSaleValueSetter" name="is_preSale">
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
                          
                    
      