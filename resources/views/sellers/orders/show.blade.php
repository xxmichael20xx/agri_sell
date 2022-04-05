@extends('voyager::master')
@section('content')
<style>
        ol.breadcrumb.hidden-xs {
        display: none;
    }
    </style>
    <script>
        
        </script>
    <div class="page-content"  style="padding: 20px;">
    <a class="btn btn-primary" href="/seller/orders">Go back</a>
    <h3>Order Summary</h3>

<table class="table">

    <thead>
        <tr>
            <th>Name</th>
            <th>Qty</th>
            <th>Price</th>
        </tr>
    </thead>
    <tbody>
        @php
        use app\Product;
        @endphp
        @foreach ($items as $item)
        {{-- Get if the item has Sale or discounted price this will fix the regular price bug --}}

        @php
           $item_product_pivot = Product::where('id', $item->id)->first();
           $item_product_pivot_price = $item_product_pivot->price;
           $item_product_price_proc = 0;
           if($item_product_pivot->is_sale==1){
                $item_product_price_proc = $item->price - (($item_product_pivot->sale_pct_deduction / 100) * $item->price);
           }else{
               $item_product_price_proc = $item->price;
           }
        @endphp
      

        <tr>
            <td scope="row">
                {{$item->name}}
                <!-- {{$item->id}} -->
            </td>
            <td>
                {{$item->pivot->quantity}}
            </td>
            <td>
            @if ($item_product_pivot->is_sale==1)
            <s>{{$item->pivot->price}}</s>
            {{$item_product_price_proc}}
           @else
           {{$item_product_price_proc}}

           @endif
         
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

</div>
@stop

@section('javascript')


@stop

