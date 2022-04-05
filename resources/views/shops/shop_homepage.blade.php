@extends('layouts.front')


@section('content')

@php
            use App\Product;
            $shopProducts = Product::where('shop_id', $shop->id)->get();
            $sumAverageRating = 0;
            $ratings_ocurr = 0;
            foreach($shopProducts as $shopProduct){
                $sumAverageRating += $shopProduct->averageRating();
                if($shopProduct->averageRating() != 0 || $shopProduct->averageRating() != NULL){
                    $ratings_ocurr++;     
                }
            }
            $shopAveRating = 0;
            if($ratings_ocurr != 0 && $sumAverageRating != 0){
                $shopAveRating = round($sumAverageRating/$ratings_ocurr, 1);
            }else{
                $shopAveRating = 'Unrated';
            }

        @endphp
<div class="breadcrumb-area pt-205 breadcrumb-padding pb-210 bg-success"
   style="background-image: url('https://hbr.org/resources/images/article_assets/2021/08/Sep21_02_1176415931.jpg');background-size:cover;" >
    <div class="container-fluid">
        <div class="breadcrumb-content text-center">
            <h2>{{$shop->name}}</h2>
            @if ($shopAveRating != 'Unrated')
            <div class="product-rating-4" >
                <!-- <span class="text-white">{{$shopAveRating}}</span> -->
                <i class="icofont icofont-star {{(floatval($shopAveRating) >= 1) ? 'yellow' : '' }}"></i>
                <i class="icofont icofont-star {{(floatval($shopAveRating) >= 2) ? 'yellow' : '' }}"></i>
                <i class="icofont icofont-star {{(floatval($shopAveRating) >= 3) ? 'yellow' : '' }}"></i>
                <i class="icofont icofont-star {{(floatval($shopAveRating) >= 4) ? 'yellow' : '' }}"></i>
                <i class="icofont icofont-star {{(floatval($shopAveRating) >= 5) ? 'yellow' : '' }}"></i>
            </div>
            @else
                <span class="text-white">Unrated</span>
            @endif
           
            <h5 class="text-white">{{$shop->owner->name}}</h5>
            <h5 class="text-white">{{$shop->owner->address_line}} {{$shop->owner->barangay}} {{$shop->owner->town}} {{$shop->owner->province}} </h5>

            <span class="text-white">{{$shop->description}}</span>
           
        </div>
    </div>
</div>


<div class="shop-page-wrapper shop-page-padding ptb-100">
    <div class="container-fluid">
        <div class="row">
         
            <div class="col-lg-12">
                <div class="shop-product-wrapper res-xl res-xl-btn">
                    <div class="shop-bar-area">
                        <div class="shop-bar pb-60">
                            <div class="shop-found-selector">
                                <div class="shop-found">
                                    <p><span>{{$products->total()}}</span> Products Found </p>
                                </div>

                            </div>

                        </div>
                        <div class="shop-product-content tab-content">
                            <div id="grid-sidebar1" class="tab-pane fade active show">
                                <div class="row">
                                    @foreach($products as $product)
                                            @include('product._single_product')
                                    @endforeach

                                </div>
                            </div>

                        </div>
                    </div>
                </div>


                    {{$products->appends(['query'=>request('query')])->render()}}
            </div>
        </div>
    </div>
</div>

@endsection
