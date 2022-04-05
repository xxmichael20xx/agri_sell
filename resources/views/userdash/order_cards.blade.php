<div class="row">
    <div class="col col-lg-12">


        @php
            /** @var TYPE_NAME $order_disp_type */
            if ($order_disp_type != 'all'){
            $orders = DB::table('orders')->where([['user_id', '=', Auth::user()->id],['status', '=',
            $order_disp_type]])->get();
            }else{
            $orders = DB::table('orders')->where('user_id', '=', Auth::user()->id)->get();
            }
        @endphp
        @foreach($orders as $order)
            <div class="card border-1 mt-1">
                <div class="card-header bg-light  border-0">
                    @if ($status_id == 1)
                    <span class="text-left">{{ $order->created_at }} </span>
                    @else
                    <span class="text-left">{{ $order->updated_at }} </span>
                    @endif
                    <span style="float:right;">{{ $order->status }} </span>
                </div>
                <div class="card-body">
                    <table class="table">

                        @php
                            $order_items = DB::table('order_items')->where('order_id', '=', $order->id)->get();
                        @endphp
                        @foreach($order_items as $order_item)
                            <tr>
                                @php
                                    $product_item = DB::table('products')->where('id', '=',
                                    $order_item->product_id)->first();
                                @endphp


                                <th scope="row" width="30">
                                    @if(!empty($product_item->cover_img))
                                        <img src="{{ asset('storage/'.$product_item->cover_img) }}"
                                            alt="" height="70" width="70">
                                    @else
                                        <img src="/assets/img/product/electro/1.jpg" alt="">
                                    @endif
                                </th>
                                <td width="350">
                                    @if ($order->status == 'completed')
                                    @php
                                        $prid = $product_item->id;
                                    @endphp
                                    @livewireStyles
                                        <livewire:orders-product-ratings :prid="$prid"  />
                                        @livewireScripts
                                    @endif
                                   
                                            {{ $product_item->name }}
                                            @if($product_item->is_sale == 1)
                                                <s>₱ {{ $product_item->price }}</s>
                                                <h5>
                                                    ₱
                                                    {{ $product_item->price - (($product_item->sale_pct_deduction / 100) * $product_item->price) }}
                                                    x {{ $order_item->quantity }} </h5>
                                            @else
                                                <h5>₱ {{ $product_item->price }}</h5>
                                            @endif
                                </td>
                            </tr>
                        @endforeach

                    </table>
                </div>
                <div class="card-footer border-0">Order totals - {{ $order->grand_total }}</div>
            </div>
        @endforeach


    </div>
</div>
