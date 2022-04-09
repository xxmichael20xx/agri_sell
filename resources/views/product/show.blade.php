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
            <div class="row" onload="defValue()">
                <div class="col-md-12 col-lg-7 col-12">
                    @php
                        $product_variations_counter = 0;
                        $product_variations = DB::table('product_variations')->where('product_id', $product->id)->get();
                        $product_variation_max_price = DB::table('product_variations')->where('product_id', $product->id)->max('variation_price_per');
                        $product_variation_min_price = DB::table('product_variations')->where('product_id', $product->id)->min('variation_price_per');
                        $product_variation_count_qty = DB::table('product_variations')->where('product_id', $product->id)->sum('variation_quantity');
                        $product_variation_range = $product_variation_min_price != $product_variation_max_price ? '₱' . $product_variation_min_price . '- ₱' . $product_variation_max_price : '₱' . $product_variation_max_price;
                    @endphp

                    <div class="product-details-img-content">
                        <div class="product-details-tab mr-70">
                            <div class="product-details-large tab-content">
                                @php
                                    $images = $product->secondary_cover_img ?? 'not available';
                                    $pieces = explode(',', $images);
                                    $image_counter = 0;
                                @endphp
                                @foreach ($pieces as $piece)
                                    @php
                                        $image_counter++;
                                    @endphp
                                    @if ($image_counter == 1)
                                        <div class="tab-pane active show fade" id="pro-details{{ $image_counter }}"
                                            role="tabpanel">
                                            <div class="">
                                                <a href="{{ env('APP_URL') }}/storage/{{ $piece }}">
                                                    <div
                                                        style="width: 600px; height: 656px;background-position: center;background-size: cover;background-image: url('{{ env('APP_URL') }}/storage/{{ $piece }}');">
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    @else
                                        <div class="tab-pane fade" id="pro-details{{ $image_counter }}" role="tabpanel">
                                            <div class="">
                                                <a href="{{ env('APP_URL') }}/storage/{{ $piece }}">
                                                    <div
                                                        style="width: 600px; height: 656px;background-position: center;background-size: cover;background-image: url('{{ env('APP_URL') }}/storage/{{ $piece }}');">
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach

                            </div>
                            <div class="product-details-small nav mt-12" role=tablist>
                                @php
                                    $images = $product->secondary_cover_img ?? 'not available';
                                    $pieces = explode(',', $images);
                                    $image_counter = 0;
                                @endphp
                                @foreach ($pieces as $piece)
                                    @php
                                        $image_counter++;
                                    @endphp
                                    @if ($image_counter == 1)
                                        <a class="active mr-12 mt-1" href="#pro-details{{ $image_counter }}"
                                            data-toggle="tab" role="tab" aria-selected="true">
                                            <div
                                                style="width: 141px; height: 135px;background-position: center;background-size: cover;background-image: url('{{ env('APP_URL') }}/storage/{{ $piece }}');">
                                            </div>
                                        </a>
                                    @else
                                        <a class="mr-12 mt-1" href="#pro-details{{ $image_counter }}" data-toggle="tab"
                                            role="tab" aria-selected="true">
                                            <div
                                                style="width: 141px; height: 135px;background-position: center;background-size: cover;background-image: url('{{ env('APP_URL') }}/storage/{{ $piece }}');">
                                            </div>
                                        </a>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 col-lg-5 col-12">
                    <div class="product-details-content">
                        <h1>{{ $product->name }}</h1>
                        <div class="d-block"></div>
                        @php
                            $productAveRating = $product->averageRating();
                            $productAveRating = round($productAveRating);
                            
                            $tagClass = $product->is_whole_sale ? 'wholesale' : 'retail';
                            $tagTitle = $product->is_whole_sale ? 'Wholesale' : 'Retail';
                        @endphp

                        <a href="javascript:void(0)" class="tag tag-{{ $tagClass }}">{{ $tagTitle }}</a>
                        <div class="d-block"></div>

                        @if ($productAveRating != '0' || $productAveRating != null)
                            <div class="rating-number">
                                <div class="quick-view-rating">
                                    {{ $productAveRating }}
                                    <a href="">
                                        <span
                                            class="fa fa-star {{ floatval($productAveRating) >= 1 ? 'checked' : '' }}"></span>
                                    </a>
                                    <a href="">
                                        <span
                                            class="fa fa-star {{ floatval($productAveRating) >= 2 ? 'checked' : '' }}"></span>
                                    </a>
                                    <a href="">
                                        <span
                                            class="fa fa-star {{ floatval($productAveRating) >= 3 ? 'checked' : '' }}"></span>
                                    </a>
                                    <a href="">
                                        <span
                                            class="fa fa-star {{ floatval($productAveRating) >= 4 ? 'checked' : '' }}"></span>
                                    </a>
                                    <a href="">
                                        <span
                                            class="fa fa-star {{ floatval($productAveRating) >= 5 ? 'checked' : '' }}"></span>
                                    </a>
                                </div>
                            </div>
                        @else
                            <span>Unrated</span>
                        @endif

                        <br>

                        @if ($product->is_pre_sale == '1')
                            <span class="lead">Pre sale</span>
                            @php
                                $date = new DateTime($product->pre_sale_deadline);
                                $finned = $date->format('Y/m/d H:i A');
                            @endphp
                            <br>
                            {{ $product->pre_sale_deadline }}
                            <br>
                            <p hidden data-countdown="{{ $finned }}" class="inline-block"></p>
                            <script>
                                $('[data-countdown]').each(function() {
                                    var $this = $(this),
                                        finalDate = $(this).data('countdown');
                                    $this.countdown(finalDate, function(event) {
                                        $this.html(event.strftime('%D days %H:%M:%S'));
                                    });
                                });
                            </script>
                        @endif
                        <div class="details-price my-2 mb-4">
                            <span class="display-3">
                                @php
                                    $product_variation_max_price = DB::table('product_variations')->where('product_id', $product->id)->max('variation_price_per');
                                    $product_variation_min_price = DB::table('product_variations')->where('product_id', $product->id)->min('variation_price_per');
                                    $product_variation_count_qty = DB::table('product_variations')->where('product_id', $product->id)->sum('variation_quantity');
                                    $product_variation_sold_per_initial = DB::table('product_variations')->where('product_id', $product->id)->pluck('variation_sold_per')->first();
                                    $product_variation_range = $product_variation_min_price != $product_variation_max_price ? '₱' . $product_variation_min_price . '- ₱' . $product_variation_max_price : '₱ ' . $product_variation_max_price;
                                    $product_variation_range_sale = $product_variation_min_price != $product_variation_max_price ? '₱' . $product_variation_min_price . '- ₱' . $product_variation_max_price : '₱ ' . ($product_variation_max_price - ($product->sale_pct_deduction / 100) * $product->product_variation_max_price);
                                @endphp
                                {{-- Product price will be replaced by javascript --}}
                                <span id="price_list">{{ $product_variation_range }}</span>
                            </span>
                        </div>
                        <a href="/shop/catalog/{{ $product->shop->id }}">{{ $product->shop->name }}</a>
                        <br>
                        <div class="my-2">
                            <span>Sold per: </span>
                            <!-- Sold per widget -->
                            @php
                                $variation_ent_tmp = App\ProductVariation::where('product_id', $product->id)->get();
                                $var_tmp_sold_per = [];
                                
                                foreach ($variation_ent_tmp as $variation_instance) {
                                    array_push($var_tmp_sold_per, $variation_instance->variation_sold_per);
                                }
                                
                                $var_tmp_sold_per = array_unique($var_tmp_sold_per);
                                
                            @endphp
                            @foreach ($var_tmp_sold_per as $var_tmp_sold_per_instance)
                                <span>{{ $var_tmp_sold_per_instance }}</span>
                            @endforeach
                        </div>
                        <!-- end of sold per widget -->
                        <div class="quick-view-select my-2">
                            Product description: {{ $product->description }}
                        </div>

                        <div class="my-5"></div>

                        <div class="fb-share-button mb-3" data-layout="button" data-size="large">
                            <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" class="fb-xfbml-parse-ignore">Share</a>
                        </div>

                        @php
                            $product_variation_if_regular = App\ProductVariation::where('product_id', $product->id)->first();
                            $product_variation_count = App\ProductVariation::where('product_id', $product->id)->count();
                            $product_variation_id_first = App\ProductVariation::where('product_id', $product->id)->pluck('id')->first();

                            $variantMinQty = 1;
                            $variantStocks = number_format( $product_variation_if_regular->variation_quantity );
                            $variantWeight = number_format( $product_variation_if_regular->variation_net_weight );
                            $variantSoldPer = $product_variation_if_regular->variation_sold_per;
                            $variantPrice = number_format( $product_variation_if_regular->variation_price_per );
                            $variantText = "Retail";
                            $variantWholesale = 'no';
                            
                            if ( $product_variation_if_regular->is_variation_wholesale == 'yes' ) {
                                $variantText = "Wholesale: Buy a minimum qty of {$variantMinQty} and the price will be ₱{$product_variation_if_regular->variation_price_per}";
                                $variantMinQty = $product_variation_if_regular->variation_min_qty_wholesale;
                                $variantWholesale = 'yes';
                            }
                        @endphp

                        <!-- changelog change GET to POST -->
                        <form method="GET" action="{{ route('cart.addWquantityVariation', $product) }}" id="add--cart-form">
                            <input type="hidden" id="variation_id_setter" name="variation_id" value="{{ $product_variation_id_first }}" required>

                            @if ( $product_variation_count > 1 )
                                <div class="form-group row">
                                    <div class="col-12">
                                        <label class="col-form-label">Select a variation</label>
                                    </div>
                                    <div class="col-12 d-flex flex-wrap">
                                        @foreach( $product_variations as $key => $variation )
                                            @php
                                                $spacing = "mx-1";
                                                $variant_btn_id = "";

                                                if ( $key == 0 ) {
                                                    $spacing = "mr-1";
                                                    $variant_btn_id = 'id="product--variant-first"';
                                                }
                                            @endphp
                                            <button 
                                                type="button"
                                                class="btn btn-outline-success {{ $spacing }} product--variation-action"
                                                data-id="{{ $variation->id }}"
                                                data-data="{{ json_encode( $variation ) }}"
                                                {{ $variant_btn_id }}>
                                                <div id="icon--placeholder"></div>
                                                @if ( $key == 0 ) 
                                                    <i class="fa fa-check"></i>
                                                @endif
                                                {{ $variation->variation_name }}
                                            </button>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            <div class="form-group row">
                                <div class="col-4">
                                    <input class="input-form" name="quantity" require type="number" value="1" id="variation_max_stock" min="{{ $variantMinQty }}">
                                </div>
                                <div class="col-8">
                                    <span>Available stocks </span> <span id="variant--stock">{{ $variantStocks }}</span>
                                    <br>
                                    <span>Product net weight</span> <span id="variant--weight">{{ $variantWeight }}</span> (g)
                                    <br>
                                    <span>Sold per </span> <span id="variant--sold-for">{{ $variantSoldPer }}</span>
                                    <span></span> <span id="variant--additional-text">{{ $variantText }}</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <span>
                                        <input class="mt-3 add--to-cart" type="submit" value="Add to cart">
                                    </span>
                                </div>
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

    <script>
        const cartFormValidated = false

        window.onload = () => {
            if ( $( '.product--variation-action' ) ) {
                $( document ).on( 'click', '.product--variation-action', function() {
                    const id = $( this ).data( 'id' )
                    const data = $( this ).data( 'data' )
                    const checkIcon = `<i class="fa fa-check"></i>`
                    const iconPlaceholder = $( this ).find( '#icon--placeholder' )

                    removeActiveIcon()

                    $( '#variation_id_setter' ).val( id )
                    $( checkIcon ).insertAfter( iconPlaceholder )

                    const variantStock = Number( data.variation_quantity ).toLocaleString()
                    const variantWeight = data.variation_net_weight
                    const variantPrice = Number( data.variation_price_per ).toLocaleString()
                    const variantWholeSaleMinQty = data.variation_min_qty_wholesale
                    const variantSoldFor = data.variation_sold_per

                    $( '#variant--stock' ).text( variantStock )
                    $( '#variant--weight' ).text( variantWeight )
                    $( '#price_list' ).text( `₱ ${variantPrice}` )
                    $( '#variation_max_stock' ).attr( 'max', variantStock )
                    $( '#variant--sold-for' ).text( variantSoldFor )

                    if ( data.is_variation_wholesale == 'yes' ) {
                        $( '#variation_max_stock' ).attr( 'min', variantWholeSaleMinQty )
                        $( '#variant--additional-text' ).text( `Wholesale: Buy a minimum qty of ${variantWholeSaleMinQty} and the price will be ₱${variantPrice}` )

                    } else {
                        $( '#variation_max_stock' ).attr( 'min', 1 )
                        $( '#variant--additional-text' ).text( 'Retail' )
                    }
                } )
            }

            /**
             * Remove the check icon inside each variant buttons
             */
            function removeActiveIcon() {
                $( '.product--variation-action' ).each( function() {
                    $( this ).find( 'i' ).remove()
                } )
            }
        }
    </script>

    {{-- reviews section --}}
    @include('product._reviews')

    <!-- related product area start -->
    {{-- @include('product._related-product') --}}
@endsection
