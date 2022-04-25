@if( Session::get( 'success' ) )
    <div class="alert alert-success">
        {{ session::get( 'success' ) }}
    </div>
@endif

<div class="card">
    <div class="card-header">
        <h4 class="card-title">Products - {{ ucfirst( $table ) }}</h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <div class="toolbar">
                <!-- Here you can write extra buttons/actions for the toolbar -->
                <div class="text-right">
                    <a class="btn btn-success text-white text-right m-3" href="/sellerpanel/add_new_product/regular">Add new</a>
                </div>
            </div>
            <table id="datatable-{{ $table }}" class="table " cellspacing="0" width="100%">
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
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Update product should be belong to the shop  rule that shop owners should manage their own shop--}}
                    @php
                        $products = App\Product::where( [ 'category_id' => $category_id, 'product_user_id' => Auth::user()->id ])->get();
                    @endphp
                    @foreach ( $products as $product )
                        @if( isset( $product ) )
                            @php
                                $product_variation_max_price = DB::table('product_variations')->where('product_id', $product->id)->max('variation_price_per'); 
                                $product_variation_min_price = DB::table('product_variations')->where('product_id', $product->id)->min('variation_price_per');
                                $product_variation_count_qty = DB::table('product_variations')->where('product_id', $product->id)->sum('variation_quantity');
                                $product_variation_range = ($product_variation_min_price != $product_variation_max_price) ? '₱' . $product_variation_min_price . '- ₱' . $product_variation_max_price : '₱ ' . $product_variation_max_price;
                                $product_variation_range_sale = ($product_variation_min_price != $product_variation_max_price) ? '₱' . $product_variation_min_price . '- ₱' . $product_variation_max_price : '₱ ' . ($product_variation_max_price - (($product->sale_pct_deduction/100) * $product->product_variation_max_price));
                                $product_variation_min_price_tmp_sale = $product_variation_min_price;
                                $product_variation_min_price_tmp_sale = $product_variation_min_price_tmp_sale - (($product->sale_pct_deduction / 100) * $product_variation_min_price_tmp_sale);
                                $product_variation_max_price_tmp_sale = $product_variation_max_price; 
                                $product_variation_max_price_tmp_sale = $product_variation_max_price_tmp_sale - (($product->sale_pct_deduction / 100) * $product_variation_max_price_tmp_sale);
                                $product_variation_range_sale = ($product_variation_min_price != $product_variation_max_price) ? '₱' . $product_variation_min_price_tmp_sale . '- ₱' . $product_variation_max_price_tmp_sale : '₱ ' . $product_variation_max_price_tmp_sale;
                                $product_cat_id = App\ProductCategory::where('product_id', $product->id)->first();
                            @endphp
                            <tr>
                                <td>
                                    {{ $product->name }}
                                    @php
                                        $tagClass = $product->is_whole_sale ? "wholesale" : "retail";
                                        $tagTitle = $product->is_whole_sale ? "Wholesale" : "Retail";
                                    @endphp
                                    <a href="javascript:void(0)" class="tag tag-{{ $tagClass }}">{{ $tagTitle }}</a>
                                </td>
                                <td>
                                    <img src="{{ asset('storage/'.$product->featured_image) }}" height="100" alt="">
                                </td>
                                <td>
                                    @if ( $product->is_sale == 1 )
                                        {{$product->sale_pct_deduction}} % off
                                        <br>
                                        Before {{$product_variation_range}}
                                        <br>
                                        After {{$product_variation_range_sale}}
                                    @else
                                        {{$product_variation_range}}
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-sm btn-primary btn-round text-white m-1" href="/sellerpanel/product_info/{{ $product->id }}">More info</a>
                                    <a class="btn btn-sm btn-primary btn-round text-white m-1" href="/sellerpanel/product_edit/{{ $product->id }}">Edit</a>
                                    <a class="btn btn-sm btn-danger btn-round text-white m-1" href="/sellerpanel/delete_product/{{ $product->id }}">Delete</a>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
