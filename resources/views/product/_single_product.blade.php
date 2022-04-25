@if(isset($product))
@if(isset($product->shop->id))
@if ($product->shop->is_active == '1')    
<div class="col-lg-4 col-xl-3 col-md-6" >
    <div class="product-fruit-wrapper mb-60">
        <div class="product-fruit-img">
        <a href="{{route('products.show', $product)}}">
        <div style="width: 100%; height: 300px;background-position: center;background-size: cover;background-image: url('{{env('APP_URL')}}/storage/{{$product->featured_image}}');" ></div>
        </a>
        </div>
        
        <div class="product-fruit-content text-center">
        <div class="product-rating-4 mb-2" >
                    @php
                    $productAveRating = $product->averageRating();
                    $productAveRating = round($productAveRating);
                    @endphp
                    @if ($productAveRating != 0 || $productAveRating != NULL)
                    <i class="icofont icofont-star {{(floatval($productAveRating) >= 1) ? 'yellow' : '' }}"></i>
                    <i class="icofont icofont-star {{(floatval($productAveRating) >= 2) ? 'yellow' : '' }}"></i>
                    <i class="icofont icofont-star {{(floatval($productAveRating) >= 3) ? 'yellow' : '' }}"></i>
                    <i class="icofont icofont-star {{(floatval($productAveRating) >= 4) ? 'yellow' : '' }}"></i>
                    <i class="icofont icofont-star {{(floatval($productAveRating) >= 5) ? 'yellow' : '' }}"></i>
                    @else
                        <span>Unrated</span>
                    @endif
            </div>
            <h4><a href="{{route('products.show', $product)}}">{{$product->name}}</a></h4>
            <span>
            @php
       

            $product_variation_max_price = DB::table('product_variations')->where('product_id', $product->id)->max('variation_price_per'); 
            $product_variation_min_price = DB::table('product_variations')->where('product_id', $product->id)->min('variation_price_per');
            $product_variation_count_qty = DB::table('product_variations')->where('product_id', $product->id)->sum('variation_quantity');
            $product_variation_range = ($product_variation_min_price != $product_variation_max_price) ? '₱' . $product_variation_min_price . '- ₱' . $product_variation_max_price : '₱ ' . $product_variation_max_price;
            $product_variation_range_sale = ($product_variation_min_price != $product_variation_max_price) ? '₱' . $product_variation_min_price . '- ₱' . $product_variation_max_price : '₱ ' . ($product_variation_max_price - (($product->sale_pct_deduction/100) * $product->product_variation_max_price));
            $product_variation_min_price_tmp_sale = $product_variation_min_price;
            $product_variation_min_price_tmp_sale = $product_variation_min_price_tmp_sale - (($product->sale_pct_deduction / 100) * $product_variation_min_price_tmp_sale);
            $product_variation_max_price_tmp_sale = $product_variation_max_price; 
             $product_variation_max_price_tmp_sale = $product_variation_max_price_tmp_sale - (($product->sale_pct_deduction / 100) * $product_variation_max_price_tmp_sale);
           $product_variation_range_sale = ($product_variation_min_price != $product_variation_max_price) ? '₱' . $product_variation_min_price_tmp_sale . '- ₱' . $product_variation_max_price_tmp_sale : '₱ ' . $product_variation_max_price_tmp_sale;


            @endphp
                @if($product->is_sale == 1)
                {{$product->sale_pct_deduction}} % off
                <br>
                Before {{$product_variation_range}}
                <br>
                After {{$product_variation_range_sale}}
                @else
                {{$product_variation_range}}
                @endif
            <br>
                
            </span>
          <!--   <div class="text-left mt-1 pt-2" hidden>
                <span {{ ($product->is_sale != '1') ? 'hidden': ''}} class="ml-3  badge-danger p-1 text-white"> {{ ($product->is_sale == '1') ? 'Sale ' . $product->sale_pct_deduction . '%' : ''}}</span>
                <span {{ ($product->is_whole_sale != '1') ? 'hidden': ''}} class="m-1 badge-primary p-1 text-white">      {{ ($product->is_whole_sale == '1') ? 'Wholesale min qty:' . $product->whole_sale_min_qty : ''}}</span>
            </div>
            <div class="text-left mt-1 pt-2">     
                <span class="m-1 badge-primary p-1 text-white">Sold per {{$product->sold_by}}</span>
            </div> -->
        
            <div class="mt-2"><a href="/shop/catalog/{{$product->shop->id}}"><span> {{$product->shop->owner->name ?? 'n/a'}} </span> <br> {{$product->shop->name ?? 'n/a'}}</a></div>
            
            <!-- Sold per widget -->
            @php
                $variation_ent_tmp = App\ProductVariation::where('product_id', $product->id)->get();
                $var_tmp_sold_per = array();

                foreach($variation_ent_tmp as $variation_instance){
                    array_push($var_tmp_sold_per, $variation_instance->variation_sold_per);
                }

                $var_tmp_sold_per = array_unique($var_tmp_sold_per);
            @endphp
            <div class="row">
                <div class="col-12">
            
                @foreach ($var_tmp_sold_per as $var_tmp_sold_per_instance)
                <span class="btn btn-light">{{$var_tmp_sold_per_instance}}</span>
                @endforeach
            
            </div>
            <!-- end of sold per widget -->
            </div>
        </div>
    </div>
</div>
@endif
@endif
@endif
