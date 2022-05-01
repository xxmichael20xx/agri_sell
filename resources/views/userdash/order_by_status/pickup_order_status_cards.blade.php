<div class="col-12">
    <div class="col col-lg-12">
        @php
            // $orders = App\SubOrder::where('pick_up_status_id', $pickup_status_id)->latest()->get();
            $param1 = [ 'pick_up_status_id', $pickup_status_id ];
            $param2 = [ 'is_pick_up', 'yes' ];
            $orders = App\SubOrder::userOrder( $param1, $param2 )->latest()->get();
        @endphp
        @forelse($orders as $order)
            <div class="card mt-1 border-0">
                <div class="card-header bg-light border-0">
                    @if ($status_id != '5')
                    <span class="text-left">{{ $order->order->order_number ?? 'not available'}} </span>
                    @endif
                    <span style="float:right;">{{ $order->order->created_at ?? 'not available'}}  </span>
                </div>
                <div class="card-body">
                    <table class="table">
                        @php
                            $order_items = App\OrderItem::where( 'order_id', $order->order->id )->get();
                        @endphp
                        @foreach ( $order_items as $order_item )
                            <tr>
                                @php
                                    $product_item = App\Product::where( 'id', $order_item->product_id )->first();
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
                                                $prid = $product_item->id;
                                            @endphp
                                            @livewireStyles
                                            <livewire:orders-product-ratings :prid="$prid"  />
                                            @livewireScripts    
                                        @endif
                                   
                                        {{ $product_item->name }}
                                        
                                        @if($product_item->is_sale == 1)
                                            <s>₱ {{ $order_item->product_variation->variation_price_per }} </s> x {{ $order_item->quantity }} 
                                            <h5>
                                                ₱
                                                {{  $order_item->product_variation->variation_price_per - (($product_item->sale_pct_deduction / 100) *  $order_item->product_variation->variation_price_per) }}
                                                    </h5>
                                        @else
                                            <h5>₱ {{ $order_item->product_variation->variation_price_per }} x {{ $order_item->quantity }} </h5>
                                        @endif  
                                    </a>
                                    <br>
                                    {{$product_item->shop->name}} 
                                    <br>              
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <div class="card-footer border-0">
                    {{-- Shipping fee added by rider --}}
                <span class="text-left">  &#8369; {{ $order_item->product_variation->variation_price_per }} </span>
                <span style="float:right;"> {{ ($order->deliverystatus->display_name == 'Not delivery') ? '' : ''}} </span></div>
            </div>
        @empty
            <p class="card-title text-center">No order(s) yet.</p>
        @endforelse
    </div>
</div>
