<div class="card">
    <div class="card-header">

        <h4 class="card-title">Products Category {{$category_name}}</h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <div class="toolbar">
                <!--        Here you can write extra buttons/actions for the toolbar
                            -->
                <div class="text-right">
                    <a hidden class="btn btn-success text-white text-right m-3" href="{{ route('add_new_product_admin') }}">Add
                        new</a>
                </div>
            </div>
            <table id="datatable{{$category_id}}" class="table " cellspacing="0" width="100%">
                <thead class=" text-primary">
                    <tr>
                        <th>
                            Name
                        </th>
                        <th>
                            Image
                        </th>
                        <th>
                            Product price
                        </th>
                        <th>
                            Shop
                        </th>
                        <th class="text-right">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Update product should be belong to the shop  rule that shop owners should manage their own shop--}}
                    @foreach ($products as $product)
                        @php
                            $product_variation_max_price = DB::table('product_variations')->where('product_id', $product->id)->max('variation_price_per');
                            $product_variation_min_price = DB::table('product_variations')->where('product_id', $product->id)->min('variation_price_per');
                            $product_variation_count_qty = DB::table('product_variations')->where('product_id', $product->id)->sum('variation_quantity');
                            $product_variation_range = ($product_variation_min_price != $product_variation_max_price) ? '???' . $product_variation_min_price . '- ???' . $product_variation_max_price : '??? ' . $product_variation_max_price;
                            $product_variation_range_sale = ($product_variation_min_price != $product_variation_max_price) ? '???' . $product_variation_min_price . '- ???' . $product_variation_max_price : '??? ' . ($product_variation_max_price - (($product->sale_pct_deduction/100) * $product->product_variation_max_price));
                            $product_variation_min_price_tmp_sale = $product_variation_min_price;
                            $product_variation_min_price_tmp_sale = $product_variation_min_price_tmp_sale - (($product->sale_pct_deduction / 100) * $product_variation_min_price_tmp_sale);
                            $product_variation_max_price_tmp_sale = $product_variation_max_price;
                            $product_variation_max_price_tmp_sale = $product_variation_max_price_tmp_sale - (($product->sale_pct_deduction / 100) * $product_variation_max_price_tmp_sale);
                            $product_variation_range_sale = ($product_variation_min_price != $product_variation_max_price) ? '???' . $product_variation_min_price_tmp_sale . '- ???' . $product_variation_max_price_tmp_sale : '??? ' . $product_variation_max_price_tmp_sale;
                        @endphp
                        @if ( isset( $product->category->category_id ) && $product->category->category_id == $category_id )
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td><img src="{{ asset( 'storage/'.$product->featured_image ) }}" height="100" alt=""></td>
                                <td>
                                    @if($product->is_sale == 1)
                                        {{$product->sale_pct_deduction}} % off
                                        <br>
                                        Before {{$product_variation_range}}
                                        <br>
                                        After {{$product_variation_range_sale}}
                                    @else
                                        {{ $product_variation_range }}
                                    @endif
                                </td>
                                <td>
                                    {{ $product->shop->name ?? 'not available' }}
                                </td>
                                <td>
                                    <a class="btn btn-sm btn-primary btn-round text-white m-1" href="/admin_seller/product_info/{{$product->id}}">More info</a>
                                    <a hidden class="btn btn-sm btn-warning btn-round text-white m-1" href="/admin_seller/product_edit/{{$product->id}}">Edit</a>
                                    <a class="btn btn-sm btn-danger btn-round text-white m-1" href="/admin_seller/delete_product/{{$product->id}}">Delete</a>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
