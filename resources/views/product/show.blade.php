@extends('layouts.front')


@section('content')
    <script>
        window.onload = function() {
            prodSetter();
        }
        </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .checked {
            color: orange;
        }

        /* Container holding the image and the text */
        .img_prod_container {
            position: relative;
            text-align: center;
            color: white;
        }

        .img_prod_centered {
            position: absolute;
            top: 50%;
            background-color: #fcfcfc;
            left: 50%;
            transform: translate(-50%, -50%);
        }
    </style>
    <div class="product-details ptb-100 pb-90">
        <div class="container">
            <div class="row" onload="defValue()">
                <div class="col-md-12 col-lg-7 col-12">
                @php
                    $product_variations_counter = 0;
                    $product_variations = DB::table('product_variations')->where('product_id', $product->id)->get();                                                  
                    $product_variation_max_price = DB::table('product_variations')->where('product_id', $product->id)->max('variation_price_per'); 
                    $product_variation_min_price = DB::table('product_variations')->where('product_id', $product->id)->min('variation_price_per');
                    $product_variation_count_qty = DB::table('product_variations')->where('product_id', $product->id)->sum('variation_quantity');
                    $product_variation_range = ($product_variation_min_price != $product_variation_max_price) ? '₱' . $product_variation_min_price . '- ₱' . $product_variation_max_price : '₱' . $product_variation_max_price;
                @endphp
               
                <div class="product-details-img-content">
                            <div class="product-details-tab mr-70">
                                <div class="product-details-large tab-content">
                                    @php
                                    $images = $product->secondary_cover_img ?? 'not available';
                                    $pieces = explode(",", $images);
                                    $image_counter = 0;
                                    @endphp
                                    @foreach ($pieces as $piece)
                                    @php
                                        $image_counter++; 
                                    @endphp
                                    @if ($image_counter == 1)
                                    <div class="tab-pane active show fade" id="pro-details{{$image_counter}}" role="tabpanel">
                                        <div class="">
                                            <a href="{{env('APP_URL')}}/storage/{{$piece}}">
                                                <div style="width: 600px; height: 656px;background-position: center;background-size: cover;background-image: url('{{env('APP_URL')}}/storage/{{$piece}}');" ></div>
                                            </a>
                                        </div>
                                    </div>
                                    @else
                                    <div class="tab-pane fade" id="pro-details{{$image_counter}}" role="tabpanel">
                                        <div class="">
                                            <a href="{{env('APP_URL')}}/storage/{{$piece}}">
                                            <div style="width: 600px; height: 656px;background-position: center;background-size: cover;background-image: url('{{env('APP_URL')}}/storage/{{$piece}}');" ></div>
                                            </a>
                                        </div>
                                    </div>
                                    @endif                          
                                    @endforeach       
                                   
                                </div>
                                <div class="product-details-small nav mt-12" role=tablist>
                                    @php
                                    $images = $product->secondary_cover_img ?? 'not available';
                                    $pieces = explode(",", $images);
                                    $image_counter = 0;
                                    @endphp
                                    @foreach ($pieces as $piece)
                                    @php
                                        $image_counter++; 
                                    @endphp
                                    @if ($image_counter == 1)
                                    <a class="active mr-12 mt-1" href="#pro-details{{$image_counter}}" data-toggle="tab" role="tab" aria-selected="true">
                                        <div style="width: 141px; height: 135px;background-position: center;background-size: cover;background-image: url('{{env('APP_URL')}}/storage/{{$piece}}');" ></div>
                                    </a>
                                    @else
                                    <a class="mr-12 mt-1" href="#pro-details{{$image_counter}}" data-toggle="tab" role="tab" aria-selected="true">
                                        <div style="width: 141px; height: 135px;background-position: center;background-size: cover;background-image: url('{{env('APP_URL')}}/storage/{{$piece}}');" ></div>
                                    </a>
                                    @endif
                                    @endforeach 
                                </div>
                            </div>
                        </div>
                </div>

                <div class="col-md-12 col-lg-5 col-12">
                    <div class="product-details-content">
                        <h1>{{$product->name}}</h1>
                        @php
                            $productAveRating = $product->averageRating();
                            $productAveRating = round($productAveRating);
                        @endphp
                        @if($productAveRating != '0' || $productAveRating != NULL)
                        <div class="rating-number">
                            <div class="quick-view-rating">
                                {{$productAveRating}}
                                <a href=""> <span
                                        class="fa fa-star {{(floatval($productAveRating) >= 1) ? 'checked' : '' }}"></span></a>
                                <a href=""> <span
                                        class="fa fa-star {{(floatval($productAveRating) >= 2) ? 'checked' : '' }}"></span></a>
                                <a href=""> <span
                                        class="fa fa-star {{(floatval($productAveRating) >= 3) ? 'checked' : '' }}"></span></a>
                                <a href=""> <span
                                        class="fa fa-star {{(floatval($productAveRating) >= 4) ? 'checked' : '' }}"></span></a>
                                <a href=""> <span
                                        class="fa fa-star {{(floatval($productAveRating) >= 5) ? 'checked' : '' }}"></span></a>
                            </div>
                        </div>
                        @else
                            <span>Unrated</span>
                        @endif
                            <br>
                        @if($product->is_pre_sale == '1')
                            <span class="lead">Pre sale</span>
                            @php
                            $date = new DateTime($product->pre_sale_deadline);
                            $finned = $date->format('Y/m/d H:i A');
                            @endphp
                            <style>
                                p{
                                    display: inline-block;
                                }
                            </style>
                            <br>
                            {{ $product->pre_sale_deadline }}
                            <br>
                <p hidden data-countdown="{{ $finned }}" ></p>
                <script>
                    $('[data-countdown]').each(function () {
                        var $this = $(this),
                            finalDate = $(this).data('countdown');
                        $this.countdown(finalDate, function (event) {
                            $this.html(event.strftime('%D days %H:%M:%S'));
                        });
                    });
                </script>
                        @endif
                        <div class="details-price">
                            <span class="display-3">
                            @php
                            $product_variation_max_price = DB::table('product_variations')->where('product_id', $product->id)->max('variation_price_per'); 
                            $product_variation_min_price = DB::table('product_variations')->where('product_id', $product->id)->min('variation_price_per');
                            $product_variation_count_qty = DB::table('product_variations')->where('product_id', $product->id)->sum('variation_quantity');
                            $product_variation_sold_per_initial = DB::table('product_variations')->where('product_id', $product->id)->pluck('variation_sold_per')->first();
                            $product_variation_range = ($product_variation_min_price != $product_variation_max_price) ? '₱' . $product_variation_min_price . '- ₱' . $product_variation_max_price : '₱ ' . $product_variation_max_price;
                            $product_variation_range_sale = ($product_variation_min_price != $product_variation_max_price) ? '₱' . $product_variation_min_price . '- ₱' . $product_variation_max_price : '₱ ' . ($product_variation_max_price - (($product->sale_pct_deduction/100) * $product->product_variation_max_price));

                            @endphp
                                {{-- Product price will be replaced by javascript --}}
                                    <span id ="price_list">{{$product_variation_range}}</span>
                            </span>
                        </div>
                        <a href="{{env('APP_URL')}}/shop/catalog/{{$product->shop->id}}">{{$product->shop->name}}</a>
                        <br>
                        <div>   
                            <span>Sold per: </span>
                                <!-- Sold per widget -->
                                @php
                                $variation_ent_tmp = App\ProductVariation::where('product_id', $product->id)->get();
                                $var_tmp_sold_per = array();

                                foreach($variation_ent_tmp as $variation_instance){
                                    array_push($var_tmp_sold_per, $variation_instance->variation_sold_per);
                                }

                                $var_tmp_sold_per = array_unique($var_tmp_sold_per);
                            @endphp
                     
                            
                                @foreach ($var_tmp_sold_per as $var_tmp_sold_per_instance)
                                <span>{{$var_tmp_sold_per_instance}}</span>
                                @endforeach
                         </div>
                        <!-- end of sold per widget -->
                        <div class="quick-view-select">
                        Product description: {{$product->description}}
                        </div>
                        <div class="fb-share-button"data-layout="button" data-size="large"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{url()->current()}}" class="fb-xfbml-parse-ignore">Share</a></div>

                        <!-- changelog change GET to POST -->
                        <form method="GET" action="{{route('cart.addWquantityVariation', $product)}}" >
                        @php
                            $product_variation_if_regular = App\ProductVariation::where('product_id', $product->id)->first();
                            $product_variation_count = App\ProductVariation::where('product_id', $product->id)->count();
                            $product_variation_id_first = App\ProductVariation::where('product_id', $product->id)->pluck('id')->first();

                            if ($product_variation_if_regular->variation_name != 'Regular' || $product_variation_count > 1){
                                $hidden_product = '';
                            }else{
                                $hidden_product = 'hidden';
                            }
                            @endphp

                                  
                        <div class="quick-view-select" {{$hidden_product}}>
                                <div class="select-option-part">
                                    <label>Variation</label>
                                    <select class="select" id="product_variation_value_selector" onchange="prodSetter()">                                        
                                       <!-- javascript array variables from php -->
                                        @php
                                            $product_variation_prices = "[";
                                            $product_variation_stocks = "[";
                                            $product_variation_ids = "[";
                                            $product_variation_net_weights = "[";
                                            $product_variation_counter = 0;

                                            // changelog mar 12 2022
                                            $product_variation_sold_pers = "[";

                                        @endphp
                                        @foreach($product_variations as $product_variation)
                                        
                                        <option value="{{$product_variations_counter}}" onchange="prodSetter()">{{$product_variation->variation_name}}</option>
                                        @php
                                            $product_variations_counter++;
                                            $product_variation_prices .= "\"" .$product_variation->variation_price_per . "\",";
                                            $product_variation_stocks .= "\"" .$product_variation->variation_quantity . "\",";
                                            $product_variation_ids .= "\"" .$product_variation->id . "\",";
                                            $product_variation_net_weights .= "\"" .$product_variation->variation_net_weight . "\",";
                                            // changelog mar 12 2022
                                            $product_variation_sold_pers  .= "\"" .$product_variation->variation_sold_per . "\",";
                                        @endphp
                                        @endforeach
                                       <!-- rtrim function for checking the excess comma in the temp var array for javascript -->
                                        @php
                                        $product_variation_prices = rtrim($product_variation_prices, ',');
                                        $product_variation_prices .= "]";
                                        $product_variation_stocks = rtrim($product_variation_stocks, ',');
                                        $product_variation_stocks .= "]";
                                        $product_variation_ids = rtrim($product_variation_ids, ',');
                                        $product_variation_ids .= "]";
                                        $product_variation_net_weights = rtrim($product_variation_net_weights, ',');
                                        $product_variation_net_weights .= "]";
                                        
                                        // changelog mar 12 2022
                                        $product_variation_sold_pers = rtrim($product_variation_sold_pers, ',');
                                        $product_variation_sold_pers .= "]";

                                        @endphp
                                    </select>
                                    <input type="hidden" required id="variation_id_setter" name="variation_id" value="none">                                    
                                    <!-- {{ $product_variation_prices }} -->
                                </div>

                                <script>

                                    // temporary array for javascript toggling
                                    var product_variation_price_list =  {!! $product_variation_prices !!};
                                    var product_variation_stock_list = {!! $product_variation_stocks !!};
                                    var product_variation_ids = {!! $product_variation_ids !!};
                                    var product_variation_net_weight_list = {!! $product_variation_net_weights !!};
                                    var product_variation_selector_element = document.getElementById("product_variation_value_selector");
          
                                    // change log march 12 2022 
                                    var product_variation_sold_per_list = {!! $product_variation_sold_pers !!};

                                    product_variation_selector_element.onchange();              

                                    // product set price according to variation
                                    function prodSetter() {
                                        // the index of the selector is being selected 
                                        var product_variation_selector_value = document.getElementById("product_variation_value_selector").value;
                                        var product_price_value = document.getElementById("price_list");
                                        var product_sale_price_value = document.getElementById("");
                                        var product_quantity_value = document.getElementById("stock_num_category");
                                        var product_net_weight_value = document.getElementById("weight_category");
                                        var product_max_stock_value = document.getElementById("variation_max_stock");
                                        var variation_id_setter = document.getElementById("variation_id_setter");
                                        var variation_wholesale_stmt = document.getElementById("variation_wholesale_stmt");

                                        // changelog mar 12 2022
                                        var variation_sold_per_value = document.getElementById("variation_sold_per");

                                        if(product_variation_selector_value == 'undefined'){
                                            product_price_value.innerHTML = "₱" + {{$product_variation_min_price}} + "- ₱" + {{$product_variation_max_price}};
                                            product_quantity_value.innerHTML = {{$product_variation_count_qty}};
                                            product_max_stock_value.max = {{$product_variation_count_qty}};
                                            // changelog mar 12 2022
                                            variation_sold_per_value.innerHTML = {{$product_variation_sold_per_initial}}
                                            
                                            var min_qty_Wholesale = product_variation_wholesale_min_list[product_variation_selector_value];
                                            var price_wholesale = product_variation_wholesale_price_pers_list[product_variation_selector_value];

                                            if(min_qty_Wholesale == 0 || price_wholesale == 1){
                                                variation_wholesale_stmt.innerHTML = "Retail";
                                            } else{
                                                variation_wholesale_stmt.innerHTML = "Wholesale: Buy a minimum qty of " + min_qty_Wholesale + " the price will be  &#8369;" + price_wholesale;
                                            }    
                                        }else{
                                            variation_id_setter.value = product_variation_ids[product_variation_selector_value];
                                            product_price_value.innerHTML = "₱" + product_variation_price_list[product_variation_selector_value];
                                            product_quantity_value.innerHTML = product_variation_stock_list[product_variation_selector_value]; 
                                            product_net_weight_value.innerHTML = product_variation_net_weight_list[product_variation_selector_value];
                                            product_max_stock_value.max =  product_variation_stock_list[product_variation_selector_value];
                                            // changelog mar 12 2022
                                            var min_qty_Wholesale = product_variation_wholesale_min_list[product_variation_selector_value];
                                            var price_wholesale = product_variation_wholesale_price_pers_list[product_variation_selector_value];
                                           
                                            variation_sold_per_value.innerHTML = product_variation_sold_per_list[product_variation_selector_value]
                                            if(min_qty_Wholesale == 0 || price_wholesale == 1){
                                                variation_wholesale_stmt.innerHTML = "Retail";
                                            } else{
                                                variation_wholesale_stmt.innerHTML = "Wholesale: Buy a minimum qty of " + min_qty_Wholesale + " the price will be  &#8369;" + price_wholesale;
                                            }    
                                        }                  
                                    }
                                    </script>

                            </div>
                        <div class="row">
                            <div class="col-4">
                                <input class="input-form" name="quantity" require type="number" value="1" id="variation_max_stock" min="1">
                            </div>
                            <div class="col-8">
                               <span>Available stocks </span> <span id="stock_num_category"></span>
                               <br>
                               <span>Product net weight</span> <span id="weight_category"></span> (g)
                               <br>
                               <span>Sold per </span> <span id="variation_sold_per"></span>
                               <span></span> <span id="variation_wholesale_stmt"></span>

                            </div>
                             <div class="col-8">
                               
                            </div>
                        </div>
                        <div class="col-12">
                        <span>
                        <input class='mt-3' type="submit" value="Add to cart">
                        </span>
                        </div>
                        </div>
                        </form>
                    <div class="quickview-plus-minus">
                        <div class="product-list-cart">  
                        </div>
                    </div>
                    <div class="product-details-cati-tag mt-35">
                        <ul>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
    {{-- reviews section --}}

    @include('product._reviews')

    <!-- related product area start -->
    {{-- @include('product._related-product') --}}

@endsection
