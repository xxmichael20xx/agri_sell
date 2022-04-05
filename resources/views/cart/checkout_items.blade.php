<h4>Basket totals</h4>
<table class="table">

    <tbody>


        @foreach($cartItems as $item)
            <tr>



                <td>{{ $item['name'] }}</td>


                <td><span class="amount">
                        @if($item['isSale'] == 1)
                            <s>₱ {{ $item['price'] }}</s><br>
                            <span>₱
                                {{ $item['price'] - (($item['salePct'] / 100) * $item['price']) }}</span>

                        @else
                            <span>₱ {{ $item['price'] }}</span>
                        @endif</span>
                        x
                        {{$item['quantity']}} =
                

                @php
                    $subtotal_cart_item = Cart::session(auth()->id())->get($item['id'])->getPriceSum();
                    $discounted_cart_item = $subtotal_cart_item - (($item['salePct'] / 100) * $subtotal_cart_item);
                @endphp
                <span class="amount">₱ {{ $discounted_cart_item }} </span>
                </td>

            </tr>
        @endforeach
        <tr>
           <td>Total quantity</td> 
           <td>{{ \Cart::session(auth()->id())->getTotalQuantity() }}</td> 
        <tr>
        <tr>
        <td>Subtotal</td> 
        <td>{{ \Cart::session(auth()->id())->getSubTotal() }}</td>
        </tr>
        <tr>
            <td>Shipping fee</td>
            <td>{{ \Cart::session(auth()->id())->getShippingFee() }}</td>
            
</tr>
<tr>
<td>Total</td>
<td>{{ \Cart::session(auth()->id())->getTotal() }}</td>
</tr>
      
    </tbody>
   
</table>




