<div class="col-12">
    <div class="col col-lg-12">
        @php
            // $orders = App\SubOrder::where('status_id', $status_id)->latest()->get();
            $param1 = [ 'status_id', $status_id ];
            $param2 = [ 'is_pick_up', 'no' ];
            $orders = App\SubOrder::userOrder( $param1, $param2 )->latest()->get();
            foreach ( $orders as $_index => $_order ) {
                if ( ! $_order->has_items ) $orders->forget( $_index );
            }
        @endphp

        @forelse( $orders as $order )
            <div class="card mt-1 border-0">
                <div class="card-header bg-light border-0 d-flex justify-content-between">
                    <span>{{ $order->order->order_number }}</span>
                    <span>{{ $order->order->created_at }}</span>
                </div>
                <div class="card-body">
                    <table class="table">
                        @php
                            $order_items = App\OrderItem::where( 'order_id', '=', $order->order->id )->latest()->get();
                        @endphp
                        @foreach($order_items as $order_item_index => $order_item)
                            @php
                                $product_item = App\Product::where('id', '=',$order_item->product_id)->first();
                            @endphp
                            @if ( $product_item )
                                <tr>
                                    <th scope="row" width="30">
                                    <a href="{{ url('products/' . $product_item->id) }}">
                                        @if( ! empty( $product_item->featured_image ) )
                                            <img src="{{ asset('storage/'.$product_item->featured_image) }}" alt="" height="150" width="150">
                                        @else
                                            <img src="/assets/img/product/electro/1.jpg" alt="">
                                        @endif
                                    </a>
                                    </th>
                                    <td width="350">
                                        <a href="{{ url('products/' . $product_item->id) }}">
                                        @if ($status_id == '5')
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
                                            <br>
                                            @php
                                                $refund_ent = App\refundModelOrder::where('order_item_id', $order_item->id)->first();
                                            @endphp
                                            @if ( ! $refund_ent )
                                                <a href="/product_refund_request_user/{{ $order->order->id }}/{{ $order_item->id }}" class="btn btn-danger">Refund</a>
                                            @endif
                                            <br>
                                        @endif
                                        {{ $product_item->name }}
                                        @if( $product_item->is_sale == 1 )
                                            <s>₱ {{ $order_item->product_variation->price }}</s>
                                            <h5>
                                                ₱
                                                {{ $order_item->product_variation->variation_price_per - (($product_item->sale_pct_deduction / 100) * $order_item->price) }}
                                                x {{ $order_item->product_variation->variation_price_per }} </h5>
                                        @else
                                            <h5>₱ {{ $order_item->product_variation->variation_price_per }}</h5>
                                        @endif
                                            </a>
                                        <br>
                                        {{ $product_item->shop->name }}
                                        @if ( $status_id == 3 )
                                            <br>
                                            <p class="mb-0">Calcelation Reason: {{ $order->order_notes }}</p>
                                            <p class="mb-0">Calcelation date: {{ AppHelpers::humanDate( $order->updated_at, true ) }}</p>
                                        @endif{{ $product_item->shop->name }}
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </table>
                </div>
                <div class="card-footer border-0">
                    <span class="text-left">  &#8369;  {{ $order->order->grand_total}} </span>
                    <span style="float:right;">  {{ $order->deliverystatus->display_name }}</span>
                </div>
            </div>
        @empty
            <p class="card-title text-center">No order(s) yet.</p>
        @endforelse
    </div>
</div>
