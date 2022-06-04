@extends('admin.front')
@section('content')

@php

@endphp
    <div class="content" onload="changeProductVariationDisplay()">
        <a href="/admin/manage_products" class="btn btn-outline-dark btn-round m-1 mb-2">Go back</a>
        <div class="row">
            <div class="col col-12 col-lg-9">
                <div class="card">
                    <form method="POST" id="editProduct" enctype="multipart/form-data" action="/admin_seller/product_edit_submit/">
                        @csrf
                        @method('POST')
                    </form>

                    <div class="card-header">
                        <h4>Edit product for {{$product->name}}</h4>
                    </div>
                    <input type="hidden" form="editProduct" name="product_id" value="{{$product->id}}" >
                    <div class="card-body">
                    <div class="row">
                        <label class="col-md-3 col-form-label">New product name</label>
                        <div class="col-md-9">
                            <div class="form-group">
                                <input required type="text" class="form-control" form="editProduct" name="product_name" value="{{$product->name}}"
                                    placeholder="">
                            </div>
                        </div>
                    </div>
                        
                        <div class="row">

                        <label class="col-md-3 col-form-label">New product images</label>
                            <div class="col-md-9">
                            <script>
                                function preview_images() 
                                {
                                var total_file=document.getElementById("images").files.length;
                                for(var i=0;i<total_file;i++)
                                {
                                $('#image_preview').append("<div class='col-md-3'><img class='img-responsive' src='"+URL.createObjectURL(event.target.files[i])+"'></div>");
                                }
                                }
                                </script>
                                <div class="col-md-12">
                                    <div class="row">
                                @php
                                    $images = $product->secondary_cover_img ?? 'not available';
                                    $images = rtrim($images, ',');
                                    $pieces = explode(",", $images);
                                    @endphp
                                    @foreach ($pieces as $piece)
                                 
                                    <div class="col-md-6 mt-1"><img src="/storage/{{$piece}}"></div>
                                                       
                                    @endforeach   
                            </div>
                                <input type="file" class="form-control" id="images"  form="editProduct" name="images[]" onchange="preview_images();" multiple/>
                                </div>
                                
                                <div class="row" id="image_preview">    
                                </div>

                            </div>
                        </div>
                        @php
                           $product_variation_ent_first = App\ProductVariation::where('product_id', $product->id)->first();
                           $product_variation_name = $product_variation_ent_first->variation_name;
                        @endphp
                        <div class="row">
                            <label class="col-md-3 col-form-label">Is your product have variations?</label>
                            <div class="col-9 mt-2">
                                <input required class="bootstrap-switch" type="checkbox" onchange="changeProductVariationDisplay()"
                                       id="switch_is_product_variation" data-toggle="switch"
                                       data-on-label="<i class='nc-icon nc-check-2'></i>"
                                       data-off-label="<i class='nc-icon nc-simple-remove'></i>" data-on-color="success"
                                       data-off-color="success" {!! ($product_variation_name != 'Regular') ? 'checked' : '' !!} />
                                <input type="hidden" id="ishaveProductVariation" form="editProduct" name="is_have_variation" value="no">
                            </div>
                        </div>
                      
                       

                        <div class="row" id="product_variation_container">
                            <label class="col-md-3 col-form-label">Product variation </label>
                            <div class="col-9">
                            <div class="multi-field-wrapper">       
                                <div class="multi-fields ">
                                    @php
                                        $product_variations = App\ProductVariation::where('product_id', $product->id)->get();
                                    @endphp
                                    @foreach ($product_variations as $product_variation)
                                    <div class="multi-field">
                                        <label>Variation name</label>
                                        <input type="text" class="form-control" form="editProduct" name="variation_name[]" value="{{$product_variation->variation_name}}">
                                        <label>Variation price</label>
                                        <input type="text" class="form-control" form="editProduct" name="variation_price[]" value="{{$product_variation->variation_price_per}}">
                                        <label>Variation net weight(kilograms)</label>
                                        <input type="text" class="form-control" form="editProduct" name="variation_net_weight[]" value="{{$product_variation->variation_net_weight}}">
                                        <label>Variation quantity</label>
                                        <input type="text" class="form-control" form="editProduct" name="variation_quantity[]" value="{{$product_variation->variation_quantity}}">
                                        <button type="button" class="btn btn-danger remove-field">Remove</button>
                                    </div>
                                    @endforeach
                                    

                                   
                                </div>
                                <button type="button" class="add-field btn btn-warning">Add new variation</button>
                            </div>
                            <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
                            <script>
                            $('.multi-field-wrapper').each(function() {
                                var $wrapper = $('.multi-fields', this);
                                $(".add-field", $(this)).click(function(e) {
                                    $('.multi-field:first-child', $wrapper).clone(true).appendTo($wrapper).find('input').val('').focus();
                                });
                                $('.multi-field .remove-field', $wrapper).click(function() {
                                    if ($('.multi-field', $wrapper).length > 1)
                                        $(this).parent('.multi-field').remove();
                                });
                            });
                            </script>
                            </div>
                        </div>
                        <div class="row"> 
                            <label class="col-md-3 col-form-label">Product category </label>
                            <div class="col-md-9">
                                @php
                                    $product_categories = App\Category::all();
                                    $product_category_ent = DB::table('product_categories')->where('product_id', $product->id)->first();
                                    
                                @endphp
                                <select class="selectpicker w-100" data-style="btn btn-primary btn-round" form="editProduct" title="Select product category" name="category_id" required>
                                    @foreach ($product_categories as $product_category)
                                        <option value="{{$product_category->id}}" {!! ($product_category_ent->category_id == $product_category->id) ? 'selected' : '' !!}>{{$product_category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-md-3 col-form-label">Shop name</label>
                            <div class="col-md-9">
                                <select class="selectpicker w-100" data-style="btn btn-primary btn-round" form="editProduct" title="Select shop" name="shop_id" required>
                                    @foreach ($shops as $shop)
                                        <option value="{{$shop->id}}" {{($product->shop->id == $shop->id) ? 'selected' : ''}} >{{$shop->name}}-{{$shop->owner->name ?? 'not available'}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                     
                        <div class="row">
                            <label class="col-md-3 col-form-label">New product description</label>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <textarea type="text" class="form-control" form="editProduct"  name="product_desc">{{$product->description}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-md-3 col-form-label">Regular product price</label>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input required type="number" class="form-control" form="editProduct" value="{{$product->price}}" name="product_price"
                                           value="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-md-3 col-form-label">Regular product weight(kilogram)</label>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input required type="number" class="form-control" form="editProduct" value="{{$product->net_weight}}" name="product_weight_regular"
                                           value="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-md-3 col-form-label">Sale precentage deduction</label>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input required type="number" class="form-control" form="editProduct" value="{{$product->sale_pct_deduction}}" name="sale_pct_deduction"
                                           value="">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-3 col-form-label">Product pre sale deadline</label>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input required type="text" name="pre_sale_deadline" value="{{$product->pre_sale_deadline}}" form="editProduct" class="form-control datetimepicker" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-md-3 col-form-label">Stocks</label>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input required type="number" class="form-control" form="editProduct" value="{{$product->stocks}}" name="stocks">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-md-3 col-form-label">Wholesale</label>
                            <div class="col-md-4">
                                <input required class="bootstrap-switch" type="checkbox" onchange="changeIsProductWholeSaleStatus()"
                                       id="switch_is_prod_wholesale" data-toggle="switch"
                                       data-on-label="<i class='nc-icon nc-check-2'></i>"
                                       data-off-label="<i class='nc-icon nc-simple-remove'></i>" data-on-color="success"
                                       data-off-color="success" {{($product->is_whole_sale == '1') ? 'checked' : ''}}/>
                                <input type="hidden" id="isWholeSaleValueSetter" form="editProduct" value={{$product->is_whole_sale}} name="is_wholeSale">
                            </div>
                        </div>
                        <script>
                            function changeIsProductWholeSaleStatus() {
                                var checkBoxIsProductWholeSale = document.getElementById("switch_is_prod_wholesale")
                                if (checkBoxIsProductWholeSale.checked == true) {
                                    document.getElementById('isWholeSaleValueSetter').value = "1";
                                } else {
                                    document.getElementById('isWholeSaleValueSetter').value = "0";
                                }
                            }
                        </script>

                        <div class="row">
                            <label class="col-md-3 col-form-label">Sale</label>
                            <div class="col-md-4">
                                <input required class="bootstrap-switch" type="checkbox" onchange="changeIsProductSaleStatus()"
                                       id="switch_is_prod_sale" data-toggle="switch"
                                       data-on-label="<i class='nc-icon nc-check-2'></i>"
                                       data-off-label="<i class='nc-icon nc-simple-remove'></i>" data-on-color="success"
                                       data-off-color="success" {{($product->is_whole_sale == '1') ? 'checked' : ''}} />
                                <input required type="hidden" id="isSaleValueSetter" form="editProduct" name="is_Sale" value="{{$product->product_sale}}">
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
                                <input required class="bootstrap-switch" type="checkbox" onchange="changeIsProductPreSaleStatus()"
                                       id="switch_is_prod_presale" data-toggle="switch"
                                       data-on-label="<i class='nc-icon nc-check-2'></i>"
                                       data-off-label="<i class='nc-icon nc-simple-remove'></i>" data-on-color="success"
                                       data-off-color="success" />
                                <input required type="hidden" id="isPreSaleValueSetter" form="editProduct" value="{{$product->is_sale}}" name="is_preSale">
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
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-warning btn-round" form="editProduct">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function changeProductVariationDisplay(){
            var product_variation_container = document.getElementById("product_variation_container");
            var is_have_variation = document.getElementById("ishaveProductVariation");
            var is_product_varitaion_check = document.getElementById("switch_is_product_variation");
            var is_product_have_variation_value = document.getElementById("ishaveProductVariation");
                if (is_product_varitaion_check.checked == true) {
                    product_variation_container.style.display = "initial"; 
                    is_product_have_variation_value.value="yes";
     
                }else{
                    product_variation_container.style.display = "none"; 
                    is_product_have_variation_value.value = "no";
                }

        }
    </script>
@endsection
