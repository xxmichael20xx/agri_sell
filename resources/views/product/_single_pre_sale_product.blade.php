@php
$date = new DateTime($pre_sale_product->pre_sale_deadline);
$finned = $date->format('Y/m/d H:i A');
$date_now = new DateTime();
$date_now_formatted = $date_now->format('Y/m/d H:i: A');

@endphp
@if ($pre_sale_product->shop->is_active == '1')    
@if (isset($pre_sale_product->shop->id) || $pre_sale_product->shop->id == NULL)
<div class="custom-col-5 custom-col-style mb-65">
<style>
    p {
        display: inline-block;
    }
</style>
<div class="product-wrapper">
    <div class="product-img">
        <a href="{{ route('products.show', $pre_sale_product) }}">
        <div style="width: 100%; height: 400px;background-position: center;background-size: cover;background-image: url('{{env('APP_URL')}}/storage/{{$pre_sale_product->cover_img}}');" ></div>
            <!-- <img style="width: 312px; height: 400px;background-position: center;background-image: url('{{ env('APP_URL')}}/storage/{{$pre_sale_product->cover_img}}');" /> -->
        </a>
        <div class="product-action">
            <a class="animate-top bg-success" title="Add To Cart" href="{{ route('cart.add', $pre_sale_product->id) }}">
                <i class="pe-7s-cart"></i>
            </a>
            <a class="animate-right bg-success" title="Quick View"
                href="{{ route('products.show', $pre_sale_product) }}">
                <i class="pe-7s-look"></i>
            </a>
        </div>
    </div>


    <div class="funiture-product-content text-center ">
        Product available until
        <br>
        {{ $pre_sale_product->pre_sale_deadline }}
        <p data-countdown="{{ $finned }}" hidden></p>
        <script>
            $('[data-countdown]').each(function () {
                var $this = $(this),
                    finalDate = $(this).data('countdown');
                $this.countdown(finalDate, function (event) {
                    $this.html(event.strftime('%D days %H:%M:%S'));
                });
            });
        </script>
        <h4>
            <a href="{{ route('products.show', $pre_sale_product) }}">{{ $pre_sale_product->name }}</a>
        </h4>

        <h3>&#8369; {{ $pre_sale_product->price }}</h3>
        <!-- <div class="text-left mt-1 pt-2">
                <span {{ ($pre_sale_product->is_sale != '1') ? 'hidden': ''}} class="ml-3  badge-danger p-1 text-white"> {{ ($pre_sale_product->is_sale == '1') ? 'Sale ' . $pre_sale_product->sale_pct_deduction . '%' : ''}}</span>
                <span {{ ($pre_sale_product->is_whole_sale != '1') ? 'hidden': ''}} class="m-1 badge-primary p-1 text-white">      {{ ($pre_sale_product->is_whole_sale == '1') ? 'Wholesale min qty:' . $pre_sale_product->whole_sale_min_qty : ''}}</span>
            </div> -->
    </div>
</div>
</div>
@endif
@endif
