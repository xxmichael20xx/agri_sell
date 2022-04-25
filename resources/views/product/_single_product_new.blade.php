<div class="col-lg-4 col-xl-3 col-md-6">
    <div class="product-fruit-wrapper mb-60">
        <div class="product-fruit-img">

            <img src="{{asset('storage/'.$product->featured_image)}}" alt="">
            <div class="product-furit-action">
                <a class="furit-animate-left" title="Add To Cart" href="{{route('cart.add', $product->id)}}">
                    <i class="pe-7s-cart"></i>
                </a>
                <a class="furit-animate-right" title="Look" href="{{route('products.show', $product)}}">
                    <i class="pe-7s-look"></i>
                </a>
            </div>
        </div>
        
        <div class="product-fruit-content text-center">
        <div class="product-rating-4 mb-2" >
            @php
                        $productAveRating = $product->averageRating();
                        $productAveRating = round($productAveRating);
                    @endphp
                    @if ($productAveRating != 0 || $productAveRating != NULL)
                    <i class="icofont icofont-star {{(floatval($productAveRating) >= 1) ? 'yellow' : '' }}"></i>
                <i class="icofont icofont-star  {{(floatval($productAveRating) >= 2) ? 'yellow' : '' }}"></i>
                <i class="icofont icofont-star  {{(floatval($productAveRating) >= 3) ? 'yellow' : '' }}"></i>
                <i class="icofont icofont-star  {{(floatval($productAveRating) >= 4) ? 'yellow' : '' }}"></i>
                <i class="icofont icofont-star  {{(floatval($productAveRating) >= 5) ? 'yellow' : '' }}"></i>
                        @else
                        <span>Unrated</span>
                    @endif
             
            </div>
            <h4><a href="{{route('products.show', $product)}}">{{$product->name}}</a></h4>
            <span> @if($product->is_sale == 1)
                <s>₱ {{$product->price}}</s>
                <br>
                ₱ {{$product->price - (($product->sale_pct_deduction / 100) * $product->price)}}
            @else
                ₱ {{$product->price}}
            @endif</span>
            <div class="text-left mt-1 pt-2">
                <span {{ ($product->is_sale != '1') ? 'hidden': ''}} class="ml-3  badge-danger p-1 text-white"> {{ ($product->is_sale == '1') ? 'Sale ' . $product->sale_pct_deduction . '%' : ''}}</span>
                <span {{ ($product->is_whole_sale != '1') ? 'hidden': ''}} class="m-1 badge-primary p-1 text-white">      {{ ($product->is_whole_sale == '1') ? 'Wholesale' : ''}}</span>
            
            </div>
            <div class="mt-2"><a href="/shop/catalog/{{$product->shop->id}}"><span> {{$product->shop->owner->name ?? 'n/a'}} </span> <br> {{$product->shop->name ?? 'n/a'}}</a></div>
        </div>
    </div>
</div>
