@extends('layouts.front')


@section('content')
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
        <div class="row">
            <div class="col-md-12 col-lg-7 col-12">
                <div class="product-details-5 pr-70">
              
                    <img src="{{asset('storage/'.$product->featured_image)}}" alt="">
                </div>

            </div>
            <div class="col-md-12 col-lg-5 col-12">
                <div class="product-details-content">
                    <h3>{{$product->name}}</h3>
                    @php
                        $productAveRating = $product->averageRating();
                        $productAveRating = round($productAveRating);

                        $productRating = $product->product_ratings_avg;
                    @endphp

                    <div  class="rating-number">
                        <div class="quick-view-rating">
                            {{$productRating}}
                            <a href=""> <span class="fa fa-star {{(floatval($productRating) >= 1) ? 'checked' : '' }}" ></span></a>
                            <a href=""> <span class="fa fa-star {{(floatval($productRating) >= 2) ? 'checked' : '' }}" ></span></a>
                            <a href=""> <span class="fa fa-star {{(floatval($productRating) >= 3) ? 'checked' : '' }}" ></span></a>
                            <a href=""> <span class="fa fa-star {{(floatval($productRating) >= 4) ? 'checked' : '' }}" ></span></a>
                            <a href=""> <span class="fa fa-star {{(floatval($productRating) >= 5) ? 'checked' : '' }}" ></span></a>
                           
                        </div>
                        
                    </div>
                    <div class="details-price">
                        @if($product->is_sale == 1)
                            <s>₱ {{$product->price}}</s>
                            <span>₱ {{$product->price - (($product->sale_pct_deduction / 100) * $product->price)}}</span>
                        @else
                            <span>₱ {{$product->price}}</span>
                        @endif
                    </div>
                    <a href="/shop/catalog/{{$product->shop->id }}">{{ $product->shop->name }}</a>
                    @if ($product->stocks <= 0)
                        <p>OUT OF STOCK</p>
                    @else
                    <p> Available stocks: {{$product->stocks}}</p>
                    @endif
                    <p>{!! $product->description !!}</p>
                    <form method="GET" action="{{route('cart.addwithquantity', $product)}}">

                    <div class="row">
                        <div class="col-4">
                        <input class="input-form" name="quantity" type="number" value="1"> 
                        </div>
                        <div class="col-4">
                        <span>Sold per {{$product->sold_by}}</span>
</div>
                    </div>
                        <div class="col-12">
                        <span><input class='mt-3' type="submit" value="Add to cart">
</span>
                        </div>
                    </div>

</form>
             
                    <div class="quickview-plus-minus">
                    <div class="product-list-cart">
                    </div>
                    <div class="product-details-cati-tag mt-35">
                        <ul>
                            <li class="categories-title">Category</li>

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
