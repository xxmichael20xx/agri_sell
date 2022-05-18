<div class="col-12">
    <div class="col col-lg-12">
        @php
            // $orders = App\SubOrder::where('status_id', $status_id)->latest()->get();
            $param1 = [ 'status_id', $status_id ];
            $param2 = [ 'is_pick_up', 'no' ];
            $orders = App\SubOrder::userOrder( $param1, $param2 )->latest()->get();
        @endphp

        @forelse( $orders as $order )
            <div class="card mt-1 border-0">
                <div class="card-header bg-light border-0">
                    @if ( $status_id != '5' )
                        <span class="text-left">{{ $order->order->order_number}} </span>
                    @endif
                    <span style="float:right;">{{ $order->order->created_at }} </span>
                </div>
                <div class="card-body">
                    <table class="table">
                        @php
                            $order_items = App\OrderItem::where( 'order_id', '=', $order->order->id )->latest()->get();
                        @endphp
                        @foreach($order_items as $order_item)
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
                                                $prid = $product_item->id;
                                            @endphp
                                            @livewireStyles
                                                <livewire:orders-product-ratings :prid="$prid"  />
                                            @livewireScripts   
                                            <br>
                                            @php
                                                $refund_ent = App\refundModelOrder::where('order_item_id', $order_item->id)->first();
                                                $refund_status_ent = ($refund_ent != null) ? $refund_ent->status->slug : 'refund_available';
                                            @endphp
                                            @if($refund_status_ent == 'refund_available')
                                                <a href="/product_refund_request_user/{{$order->order->id}}/{{$order_item->id}}" class="btn btn-light">Refund</a> 
                                            @else
                                                Refund {{$refund_status_ent}}
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
