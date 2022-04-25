@php
    $cartSession = \Cart::session( auth()->id() );
    $hasInvIssues = false;
    foreach ( $cartItems as $item ) {
        $_pr = App\ProductVariation::find( $item['variation_id'] );
        if ( $_pr && $_pr->variation_quantity < 1 ) $hasInvIssues = true;
    }

    $basketOptions = array(
        'Qty', 
        'SubTotal', 
        'Total net weight(kilograms)', 
        'Total net weight(grams)', 
        'Shipping charges', 
        'Net weight additional charges', 
        'User addresses', 
        'Shop addresses',
        'Total',
        'Wholesale discounts'
    );
    $basketValues = [];
    $basketValuesTemp = [
        $cartSession->getTotalQuantity(),
        $cartSession->getSubTotal() -  $cartSession->getWholeSaleDeductions(),
        $cartSession->getTotalNetWeight() / 1000,
        $cartSession->getTotalNetWeight(),
        $cartSession->getShippingFee(),
        $cartSession->getTotalnetweightShippingAdditionals(),
        Auth::user()->town,
        implode( ' ', $cartSession->getShopAddresses() ),
        $cartSession->getTotal(),
        $cartSession->getWholeSaleDeductions()
    ];

    foreach( $basketValuesTemp as $_ ) {
        $basketValues[] = AppHelpers::numeric( $_ );
    }
@endphp
<div>
    <div class="cart-main-area pt-95 pb-100">
        <div class="container">
            @if ( $hasInvIssues )
                <div class="form-group row">
                    <div class="col-12">
                        <div class="alert alert-warning">Items in your cart has Inventory issues. Some of your item(s) may not have enough stock.</div>
                    </div>
                </div>
            @endif
            <div class="form-group row">
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
                            @forelse ( $cartItems as $item )
                                <tr>
                                    @php
                                        $product_inst = App\Product::where('id', $item['product_id'])->first();
                                        $product_variation_obj = App\ProductVariation::find($item['variation_id']);
                                    @endphp
                                    <td class="product-thumbnail">
                                        <a href="/products/{{ $item['product_id'] }}">
                                            <img src="{{ asset( 'storage/'.$item['cover_img'] ) }}" alt="" width="70" height="70">
                                        </a>
                                    </td>

                                    <td class="product-name">
                                        <a href="/products/{{ $item['product_id'] }}"> {{ $item['name'] }}</a>
                                    </td>

                                    <td class="product-quantity">
                                        <livewire:cart-update-form :item="$item" :key="$item['id']" />                        
                                    </td>

                                    <td class="product-name">
                                        <span class="amount">{{ $product_variation_obj->variation_name ?? 'no variation' }}</span>
                                    </td>

                                    <td class="product-name">
                                        <span class="amount">
                                            @if($item['isSale'] == 1)
                                                {{ $item['salePct'] }} % sale
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
                                            <span>Buy more than {{ $variation_ent->variation_min_qty_wholesale }} then the price will be &#8369; {{ AppHelpers::numeric( $variation_ent->variation_wholesale_price_per ) }} </span>
                                        @else
                                            <span class="mt-2">No wholesale price</span>
                                        @endif
                                    </td>

                                    <td class="product-price-cart">
                                        <span class="amount">
                                             @if( $item['isSale'] == 1 )
                                                <s>₱ {{ AppHelpers::numeric( $item['price'] ) }}</s><br>
                                                <span>₱ {{ AppHelpers::numeric( $item['price'] - (($item['salePct'] / 100) * $item['price']) ) }}</span>
                                            @else
                                                <span>₱ {{ AppHelpers::numeric( $item['price'] ) }}</span>
                                            @endif
                                        </span>
                                    </td>
                                    <td class="product-price-cart">
                                        <span class="amount">₱ {{ AppHelpers::numeric( $cartSession->getSubtotal_per_item($item['id'] ) ) }} </span>
                                    </td>
                                    <td class="product-remove">
                                        <a href="{{ route('cart.destroy', $item['id']) }}"><i class="pe-7s-trash"></i></a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9">No items in cart</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-md-5 ml-auto border-0">
                            <div class="cart-page-total border-0">
                                <h2>Basket totals</h2>
                                <ul>
                                    @foreach ( $basketOptions as $index => $basketOption )
                                        <li>{{ $basketOption }} <span>{{ $basketValues[$index] }}</span></li>
                                    @endforeach
                                </ul>
                                <a href="{{ route( 'cart.checkout' ) }}">Proceed to checkout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
