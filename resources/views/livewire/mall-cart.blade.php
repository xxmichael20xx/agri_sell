<div>

    <div class="cart-main-area pt-95 pb-100">
        <div class="container">

            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <h1 class="cart-heading">Basket</h1>
                    <div class="table-content table-responsive">
                        <table>
                            <thead>
                            <tr>
                                <th></th>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Product variation</th>
                                <th>Product discounts</th>
                                <th>Wholesale price</th>
                                <th>Price</th>
                                <th>Subtotal</th>
                                <th></th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($cartItems as $item)
                                <tr>
                                    @php
                                    $product_inst = App\Product::where('id', $item['product_id'])->first();
                                    $product_variation_obj = App\ProductVariation::find($item['variation_id']);
                                    @endphp
                                    <td class="product-thumbnail">
                                        <a href=" {{env('APP_URL') . '/products/' . $item['id']}}">
                                            {{-- <span>{{Cart::session(auth()->id())->get($item['cover_img'])}}</span> --}}
                                            <img src="{{asset('storage/'.$item['cover_img'])}}" alt="" width="70"
                                                 height="70">
                                        </a>
                                    </td>

                                    <td class="product-name"><a href="{{env('APP_URL').'/products/' . $item['product_id']}}"> {{ $item['name'] }} <br> 
                                    @if (isset($product_inst->is_pre_sale))
                                        @if ($product_inst->is_pre_sale == '1')
                                            {{'Pre sale'}}
                                        @else
                                        @endif
                                    @endif
                                  </a></td>

                                    <td class="product-quantity">
                                        <livewire:cart-update-form :item="$item"  :key="$item['id']" />                        
                                    </td>

                                    <td class="product-name"><span class="amount"> {{$product_variation_obj->variation_name ?? 'no variation'}}</span>
                                    </td>

                                    <td class="product-name"><span class="amount">
                                        @if($item['isSale'] == 1)
                                        {{$item['salePct']}} % sale
                                        @else
                                        N/A
                                        @endif
                                    </span>
                                    </td>
                                    <td class="product-price-cart">
                                            @php
                                                $variation_ent = App\ProductVariation::where('id', $item['id'])->first();
                                            @endphp
                                            @if ($variation_ent->is_variation_wholesale == 'yes')
                                            <span class="mt-2">Wholesale</span><br>
                                            <span>Buy more than {{$variation_ent->variation_min_qty_wholesale}} then the price will be &#8369; {{$variation_ent->variation_wholesale_price_per}} </span>
                                            @else
                                            <span class="mt-2">No wholesale price</span>
                                            @endif
                                         
                                    </td>
                                    <td class="product-price-cart">
                                        <span class="amount">
                                             @if($item['isSale'] == 1)
                                                <s>₱ {{$item['price']}}</s><br>
                                                <span>₱ {{$item['price'] - (($item['salePct'] / 100) * $item['price'])}}</span>
                                            @else
                                                <span>₱ {{$item['price']}}</span>
                                            @endif</span>
                                         
                                    </td>
                                    <td class="product-price-cart"><span class="amount">₱ {{\Cart::session(auth()->id())->getSubtotal_per_item($item['id'])}} </span>
                                    </td>

                                <!--    <td class="product-price-cart"><span
                                            class="amount">₱{{$item['id']}}</span>
                                    </td> -->

                               
                                    <td class="product-remove">
                                        <a href="{{ route('cart.destroy', $item['id']) }}"><i class="pe-7s-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{-- <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="coupon-all">
                                <div class="coupon">
                                    <form action="{{route('cart.coupon')}}" method='get'>
                                        <input id="coupon_code" class="input-text" name="coupon_code" value=""
                                            placeholder="Coupon code" type="text" required>
                                        <input class="button" name="apply_coupon" value="Apply coupon" type="submit">
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div> --}}
                    <div class="row">
                        <div class="col-md-5 ml-auto border-0">
                            <div class="cart-page-total border-0">
                                <h2>Basket totals</h2>
                                <ul>
                                    <li>Qty<span>{{\Cart::session(auth()->id())->getTotalQuantity()}}</span></li>
                                    <li>SubTotal<span>{{\Cart::session(auth()->id())->getSubTotal() - \Cart::session(auth()->id())->getWholeSaleDeductions()}}</span></li>
                                    @php
                                        $display_array = '';
                                        $array_shop_addresses = \Cart::session(auth()->id())->getShopAddresses();
                                        foreach($array_shop_addresses as $array_shop_address){
                                            $display_array .= $array_shop_address . ' ';
                                        }
                                    @endphp
                                    <!-- <li>Total addresses<span>{{$display_array}}</span></li> -->
                                    <li class="border-0">Total net weight(kilograms)<span>{{\Cart::session(auth()->id())->getTotalNetWeight()}} g</span></li>
                                    <li class="border-0">Total net weight(grams)<span>{{\Cart::session(auth()->id())->getTotalNetWeight() / 1000}} kg</span></li>
                                    
                                    <li>Shipping charges<span>{{\Cart::session(auth()->id())->getShippingFee()}} </span></li>
                                    <li>Net weight additional charges<span>{{\Cart::session(auth()->id())->getTotalnetweightShippingAdditionals()}} </span></li>
                                    <li>User addresses<span>{{Auth::user()->town}} </span></li>
                                    <li>Shop addresses<span>{{$display_array}}</span></li>
                                    <li>Total<span>{{\Cart::session(auth()->id())->getTotal()}}</span></li>
                                    <li>Wholesale discounts {{\Cart::session(auth()->id())->getWholeSaleDeductions()}}
                                </ul>
                                <a href="{{route('cart.checkout')}}">Proceed to checkout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


