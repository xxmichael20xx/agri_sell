@extends('layouts.front')
@section('content')
        
<div class="pl-200 pr-200 overflow clearfix">
    <div class="categori-menu-slider-wrapper clearfix">
        <div class="categories-menu ">
            <div class="category-heading" style="background-color: #3997b9 !important;">
                <h3> Agri types </h3>
            </div>
            <div class="category-menu-list">
                <ul>
                    @foreach($categories as $category)
                        <li>
                            <a href="{{ route('products.index', ['category_id' => $category->id]) }}">{{ $category->name }}<i
                                    class="pe-7s-angle-right"></i></a>
                            @php
                                $children = App\Category::where('parent_id', $category->id)->get();
                            @endphp

                            @if($children->isNotEmpty())
                                <div class="category-menu-dropdown">
                                    @foreach($children as $child)
                                        <div class="category-dropdown-style category-common3">
                                            <h4 class="categories-subtitle">
                                                <a
                                                    href="{{ route('products.index', ['category_id' => $child->id]) }}">
                                                    {{ $child->name }}
                                                </a>
                                            </h4>
                                            @php
                                                $grandChild = App\Category::where('parent_id',
                                                $child->id)->get();
                                            @endphp
                                            @if($grandChild->isNotEmpty())
                                                <ul>
                                                    @foreach($grandChild as $c)
                                                        <li><a
                                                                href="{{ route('products.index', ['category_id' => $c->id]) }}">{{ $c->name }}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="menu-slider-wrapper">
            <div class="menu-style-3 menu-hover text-center">

            </div>
            <div class="slider-area">
                <div class="slider-active owl-carousel">
                    <div class="single-slider single-slider-hm3 bg-img">
                        <div class="slider-animation slider-content-style-3 fade-animated">
                            <img src="/assets/img/banner1.jpg" alt="">

                        </div>
                    </div>
                    <div class="single-slider single-slider-hm3 bg-img">
                        <div class="slider-animation slider-content-style-3 fade-animated">
                            <img src="/assets/img/banner2.jpg" alt="">

                        </div>
                    </div>
                    <div class="single-slider single-slider-hm3 bg-img">
                        <div class="slider-animation slider-content-style-3 fade-animated">
                            <img src="/assets/img/banner3.jpg" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="banner-area-two mb-5">
        <div class="container">
            <div class="row no-gutters" >
                <div class="col-lg-12">
                    <div class="section-title-furits text-center mb-95">
                        <img src="assets/img/icon-img/49.png" alt="">
                        <h2>Agrisell seller registration program</h2>
                        <div class="mt-5" style="padding:56.25% 0 0 0;position:relative;"><iframe src="https://player.vimeo.com/video/688675515?h=6971708b82&amp;badge=0&amp;autopause=0&amp;player_id=0&amp;app_id=58479" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen style="position:absolute;top:0;left:0;width:100%;height:100%;" title="agsell.mp4"></iframe></div><script src="https://player.vimeo.com/api/player.js"></script>
                    </div>
                  
                          
                </div>
            </div>
        </div>
</div>




        <div class="popular-product-area wrapper-padding-3 pt-115 pb-115" hidden>
            <div class="container-fluid">
                <div class="section-title-6 text-center mb-50">
                    <h2>Pre sale Products</h2>
                    <p>Discover pre sale products</p>
                </div>
                @php
                    $pre_sale_products_count = App\PreSaleAdapter::getActivePreSaleCount($pre_sale_products);                    
                @endphp

                <div class="product-style">
                <div class="custom-row">

                @foreach ($pre_sale_products as $pre_sale_product)
                    @include('product._single_pre_sale_product')  
                @endforeach

                </div>
                </div>
            

                
            </div>
        </div>
<div class="electro-product-wrapper wrapper-padding pt-20 pb-45">

    <div class="container-fluid">
       
        <div class="product-style-area pt-20 pb-30 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
            <div class="container">
                <div class="section-title-furits text-center mb-95">
                    <img src="assets/img/icon-img/49.png" alt="">
                    <h2>Fresh Products</h2>
                </div>
                <div class="row">
                      @foreach($allProducts as $product)
                            @include('product._single_product')
                        @endforeach
                   
                </div>
            </div>
        </div>
       
        <div class="top-product-style">

            <div>
                <div id="electro1">
                    <div class="custom-row-2 justify-content-center">
                        <div class="custom-col-style-2 custom-col-4">
                            <div class="product-wrapper product-border mb-24">
                                <div class="product-img-4">
                                    <img src="/assets/img/MarketingAdsBanner1.jpg">
                                </div>
                            </div>
                        </div>

                        <div class="custom-col-style-2 custom-col-4">
                            <div class="product-wrapper product-border mb-24">
                                <div class="product-img-4">
                                    <img src="/assets/img/MarketingAdsBanner2.jpg">

                                </div>

                            </div>
                        </div>
                        <div class="custom-col-style-2 custom-col-4">
                            <div class="product-wrapper product-border mb-24">
                                <div class="product-img-4">
                                    <img src="/assets/img/MarketingAdsBanner3.jpg">

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="banner-area-two mb-5">
    
        <div class="container">
            
            <div class="row no-gutters" >
                <div class="col-lg-12">
                <div class="section-title-furits text-center mb-95">
                <img src="assets/img/icon-img/49.png" alt="">
                    <h2>Agrisell partner shops</h2>
                </div>
                            <div class="row no-gutters">
                                @foreach ($shops as $shop)
                                @if (isset($shop->owner->role))
                                    @if ($shop->owner->role->name != 'notseller')
                                            @include('shops._single_shop')
                                    @endif
                                @endif
                                @endforeach
                            </div>
                </div>
            </div>
        </div>
</div>


        <div class="fruits-choose-area pb-65 bg-img" style="background-color: #105652;">
            <div class="container">
                
                <div class="row">
                    <div class="col-lg-12 col-xl-12 col-12">
                        <div class="fruits-choose-wrapper-all">
                            <div class="fruits-choose-title">
                                <h2>WHY AGRISELL?</h2>
                            </div>
                            <div class="fruits-choose-wrapper">
                                <div class="single-fruits-choose">
                                    <div class="fruits-choose-serial">
                                        <h3>01</h3>
                                    </div>
                                    <div class="fruits-choose-content">
                                        <h4 style="color: #FBF3E4;">Cheaper products</h4>
                                        <p class="text-white">Price is directly bought from local farmers.</p>
                                    </div>
                                </div>
                                <div class="single-fruits-choose">
                                    <div class="fruits-choose-serial">
                                        <h3>02</h3>
                                    </div>
                                    <div class="fruits-choose-content">
                                    <h4 style="color: #FBF3E4;">Smaller commision fee</h4>
                                    <p class="text-white">Starting a shop has small commision fee compare to other sites</p>
                                    </div>
                                </div>
                                <div class="single-fruits-choose">
                                    <div class="fruits-choose-serial">
                                        <h3>03</h3>
                                    </div>
                                    <div class="fruits-choose-content">
                                    <h4 style="color: #FBF3E4;">Faster delivery</h4>
                                    <p class="text-white">Agrisell has multiple rider configuration.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                  
                </div>
            </div>
        </div>






@endsection
