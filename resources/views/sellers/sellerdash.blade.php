@php
    use App\Product;
    use App\Shop;
    use App\Order;
    use App\SubOrder;

    $shop = Shop::where('user_id', Auth::id())->first();
    $shopProducts = Product::where('shop_id', $shop->id)->get();
    $sumAverageRating = 0;
    $ratings_ocurr = 0;
    foreach($shopProducts as $shopProduct){
    $sumAverageRating += $shopProduct->averageRating();
    $ratings_ocurr++;
    }
    $shopAveRating = 0;
    if($ratings_ocurr != 0 && $sumAverageRating != 0){
    $shopAveRating = round($sumAverageRating/$ratings_ocurr, 1);
    }else{
    $shopAveRating = 'Unrated';
    }
    $total_sales = 0;
    $order_count = SubOrder::where('seller_id', auth()->id())->count();
    $order_items = SubOrder::where('seller_id', auth()->id())->get();
    $order_item_price;
    $str_order_id = "";
    
    foreach($order_items as $order_item){
        if($order_item->status == 'completed')
        foreach($order_item->items as $order_ent){
            $itemprice;
            $uniprice;
            $itemprice = $order_ent->price;
            if($order_ent->is_sale == 1){
                $itemprice = $order_ent->price - (($order_ent->sale_pct_deduction/100) * $order_ent->price);
            }
            $uniprice = $itemprice * $order_ent->pivot->quantity;
            $total_sales += $uniprice;
            $str_order_id .= "\n " . $order_ent->pivot->quantity . $order_ent->name . $order_ent->price;

        }
    }
    $total_commission_deduction = 10;
    $total_sales_deduction = $total_sales - (($total_commission_deduction/100) * $total_sales);
    $total_sales_deduction_diff = $total_sales - $total_sales_deduction;
@endphp


<style>.panel.widget .dimmer {
    background: none;
}
    </style>
<div class="col-xs-12 col-sm-4 col-md-4">
    <div class="panel widget center bgimage" style="margin-bottom:0;overflow:hidden;background: #F0A500;">
        <div class="dimmer"></div>
        <div class="panel-content">
            <i class="voyager-star"></i>
            <h4> {{ $shopAveRating }}</h4>
            <p> Your average rating</p>
        </div>
    </div>
</div>
<div class="col-xs-12 col-sm-4 col-md-4">
    <div class="panel widget center bgimage" style="margin-bottom:0;overflow:hidden;background-color: #172774;">
        <div class="dimmer"></div>
        <div class="panel-content">
            <i class="voyager-bell"></i>
            <h4>{{$order_count}}</h4>
            <p>Orders</p>
        </div>
    </div>
</div>
<div class="col-xs-12 col-sm-4 col-md-4">
    <div class="panel widget center bgimage" style="margin-bottom:0;overflow:hidden;background: #082032;">
        <div class="dimmer"></div>
        <div class="panel-content">
            <i class="voyager-wallet"></i>
            <h4>{{$total_sales}}</h4>
            <p> Total Sales</p>
        </div>
    </div>
</div>
<div class="col-xs-12 col-sm-4 col-md-4">
    <div class="panel widget center bgimage" style="margin-bottom:0;overflow:hidden;background: #082032;">
        <div class="dimmer"></div>
        <div class="panel-content">
            <i class="voyager-wallet"></i>
            <h4>{{$total_sales_deduction_diff}}</h4>
            <p>Commision</p>
        </div>
    </div>
</div>
<div class="col-xs-12 col-sm-4 col-md-4">
    <div class="panel widget center bgimage" style="margin-bottom:0;overflow:hidden;background: #082032;">
        <div class="dimmer"></div>
        <div class="panel-content">
            <i class="voyager-wallet"></i>
            <h4>{{$total_sales_deduction}}</h4>
            <p>Your earnings after commission</p>
        </div>
    </div>
</div>
