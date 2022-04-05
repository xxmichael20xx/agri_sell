<div class="row">
    <div class="col col-lg-12">   
            <div class="card border-0 mt-1">
                <div class="card-header bg-light  border-0">
                    <span class="text-left">  {{$pre_sale_entity->pre_order_id}}</span>
                    <span style="float:right;">{{$pre_sale_entity->created_at}}</span>
                </div>
                <div class="card-body">
                    <table class="table">
                            <tr>
                                <th scope="row" width="30">
                                    @if(!empty($pre_sale_entity->product->cover_img))
                                        <img src="{{ asset('storage/'.$pre_sale_entity->product->cover_img) }}"
                                            alt="" height="70" width="70">
                                    @else
                                        <img src="/assets/img/product/electro/1.jpg" alt="">
                                    @endif
                                </th>
                                <td width="350">
                                {{$pre_sale_entity->product->name}}      
                                @if($pre_sale_entity->product->is_sale == 1)
                                                <s>₱ {{ $pre_sale_entity->product->price }}</s>
                                                <h5>
                                                    ₱
                                                    {{ $pre_sale_entity->product->price - (($pre_sale_entity->product->sale_pct_deduction / 100) * $pre_sale_entity->product->price) }}
                                                    x {{ $pre_sale_entity->quantity }} </h5>
                                            @else
                                                <h5>₱ {{ $pre_sale_entity->product->price }}</h5>
                                            @endif
                                </td>
                            </tr>
           

                    </table>
                </div>
                <div class="card-footer border-0">Order totals {{ $pre_sale_entity->grand_total }} </div>
            </div>



    </div>
</div>
