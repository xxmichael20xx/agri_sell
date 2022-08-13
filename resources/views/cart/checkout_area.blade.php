<div class="col-lg-6 col-md-12 col-12">
    @php
        $hasInvIssues = false;
        foreach ( $cartItems as $item ) {
            $_product_variant = App\ProductVariation::find( $item['variation_id'] );
            if ( $_product_variant && $_product_variant->variation_quantity < 1 ) {
                $hasInvIssues = true;
            }
        }
    @endphp

    <div class="your-order" style="background: none;border: none !important;">
        @if ( $hasInvIssues )
            <div class="row no-gutters">
                <div class="col">
                    <div class="alert alert-warning">Items in your cart has Inventory issues. Some of your item(s) may not have enough stock.</div>
                </div>
            </div>
        @endif
        
        <h3 style="border: none;">Your order</h3>
        <div class="your-order-table table-responsive" style="border-top: none !important;">
            <table style="border: none !important;">
                <tbody  style="border: none !important;">
                    @foreach($cartItems as $item)
                        <tr class="cart_item" style="border-top: none !important;">
                            <td style="border: none !important;" class="product-name text-left ">{{ $item['name'] }}</td>
                            <td style="border: none !important;" class="product-total text-left text-left">
                                <span class="amount">
                                    <span>Price per product ₱ {{ $item['price'] }}</span>
                                    <br>
                                    <span>₱ {{ $item['price'] }}</span>
                                    x
                                    {{ $item['quantity'] }}
                                </span>
                                <br>
                                <span class="amount">Total = ₱ {{ number_format( $item['price'] * $item['quantity'] ) }}</span>
                            </td>
                        </tr>
                    @endforeach
                    <tr style="border-bottom: 1px solid #D8D8D8;"></tr>
                </tbody>
                <tfoot>
                    <tr class="cart-subtotal text-left">
                        <th class="text-left">Basket Subtotal</th>
                        <td class="text-left"><span class="amount">₱ {{ number_format( \Cart::session(auth()->id())->getSubTotal() ) }}</span></td>
                    </tr>
                  
                    <tr class="cart-subtotal text-left">
                        <th class="text-left">Basket Shipping fee</th>
                        <td class="text-left"><span class="amount">  <span id="shipping_fee_dialog" data-shipping="₱ {{ \Cart::session(auth()->id())->getShippingFee() }}">₱ 0</span></span></td>
                    </tr>

                    <tr class="cart-subtotal-additional text-left collapse" id="shipping_fee_dialog_additional">
                        <th class="text-left">
                            Basket Additional Shipping fee
                            <br>
                            <small class="text-danger pr-3">Note: Additional shipping fee is added when you<br>reach the standard weight limit of your order.</small>
                        </th>
                        <td class="text-left"><span class="amount"><span>₱ {{ number_format( \Cart::session(auth()->id())->getTotalnetweightShippingAdditionals() ) }}</span></span></td>
                    </tr>
                  
                    <tr class="order-total text-left">
                        <th class="text-left">Order Total</th>
                        <td class="text-left"><strong><span class="amount">
                            <span id="order_total_delivery"  style="display: none;">₱ {{ number_format( \Cart::session(auth()->id())->getTotal() ) }}</span>
                            <span id="order_total_pickup" >₱ {{ number_format( \Cart::session(auth()->id())->getTotalNoShippingFee() ) }} </span>
                        </span></strong>
                        </td>
                        <!- Put a conditional statement -!> 
                        <span class="amount" id="order_total_with_shipping_fee"></span>
                        <span class="amount" id="order_total_without_shipping_fee"></span>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="payment-method">
            <div class="payment-accordion">
                <div class="panel-group" id="faq">

                </div>
                <div class="order-button-payment">
                    {{-- Place order validation agcoins not sufficient --}}
                    {{-- @if ( ! $hasInvIssues )
                        <input type="button" onclick="validateIfAgcoinsEnough()" form="billingDetails" value="Place order">
                    @else
                        <input type="button" onclick="inventoryIssue()" value="Place order">
                    @endif --}}
                    <input type="button" onclick="validateIfAgcoinsEnough()" form="billingDetails" value="Place order">
                </div>
                <script type="text/javascript">
                    function inventoryIssue() {
                        Swal.fire({
                            icon: 'info',
                            title: 'Place order failed',
                            text: `Can't place order due to Item Inventory Issue`
                        })
                    }
                </script>
            </div>
        </div>
    </div>
</div>
