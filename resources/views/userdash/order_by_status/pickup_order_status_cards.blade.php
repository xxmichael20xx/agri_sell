<div class="col-12">
    <div class="col col-lg-12">
        @php
            $param1 = [ 'pick_up_status_id', $pickup_status_id ];
            $param2 = [ 'is_pick_up', 'yes' ];
            $orders = App\SubOrder::userOrder( $param1, $param2 )->latest()->get();
            foreach ( $orders as $_index => $_order ) {
                if ( ! $_order->has_items ) $orders->forget( $_index );
            }
        @endphp
        @forelse($orders as $order)
            @php
                $order_items = App\SubOrderItem::where( 'sub_order_id', $order->order->id )->get();
                $grand_total = 0;
                $vendors = [];
            @endphp

            @if ( $order_items )
                <div class="card mt-1 border-0">
                    <div class="card-body">
                        <table class="table">
                            @foreach ( $order_items as $order_item_index => $order_item )
                                <tr>
                                    @php
                                        $product_item = App\Product::where( 'id', $order_item->product_id )->first();
                                        $grand_total = $order_item->price * $order_item->quantity;

                                        $vendor = App\Shop::where( 'user_id', $product_item->product_user_id )->first();

                                        if ( $vendor && ! in_array( $vendor->name, $vendors ) ) {
                                            $vendors[] = $vendor->name;
                                        }
                                    @endphp
                                    <th scope="row" width="30">
                                        <a href="{{ url('products/' . $product_item->id) }}">
                                            @if ( ! empty( $product_item->featured_image ) )
                                                <img src="{{ asset( 'storage/'.$product_item->featured_image ) }}" alt="" height="150" width="150">
                                            @else
                                                <img src="/assets/img/product/electro/1.jpg" alt="">
                                            @endif
                                        </a>
                                    </th>
                                    <td width="350">
                                        <a href="{{ url('products/' . $product_item->id) }}">
                                            @if ($pickup_status_id == '5')
                                                @php
                                                    $productRating = App\ProductRating::where( [ 'order_id' => $order->id, 'product_id' => $product_item->id, 'user_id' => auth()->user()->id ] )->first();
                                                    $inc = [
                                                        'rating' => $productRating->rating ?? 0,
                                                        'order_id' => $order->id,
                                                        'product_id' => $product_item->id,
                                                        'user_id' => auth()->user()->id
                                                    ];
                                                @endphp
                                                @include( 'product._rating', $inc )  
                                            @endif
                                            
                                            <h5>₱ {{ $order_item->price }} x {{ $order_item->quantity }}</h5>
                                        </a>
                                        <br>
                                        {{ $product_item->shop->name }}
                                        @if ( $pickup_status_id == 3 )
                                            <br>
                                            <p class="mb-0">Calcelation Reason: {{ $order->order_notes }}</p>
                                            <p class="mb-0">Calcelation date: {{ AppHelpers::humanDate( $order->updated_at, true ) }}</p>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    <div class="card-footer border-0">
                        <p class="mb-0 font-weight-bold">{{ $order->order->order_number }}</p>
                        <p class="mb-0"><b>Total:</b> ₱ {{ AppHelpers::numeric( $grand_total + $order->order->shipping_fee, 2 ) }}</p>
                        <p class="mb-0"><b>Shop Name:</b> {{ implode( ', ', $vendors ) }}</p>
                        <p class="mb-0"><b>Date:</b> {{ $order->order->created_at }}</p>
                    </div>
                </div>
            @endif
        @empty
            <p class="card-title text-center">No order(s) yet.</p>
        @endforelse
    </div>
</div>
