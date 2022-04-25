<div>
    @php          
        $product_variation_obj = App\ProductVariation::where('id', '=', $item['id'])->first();
        $product_obj = App\Product::find($item['product_id']);
        $min_qty_cart = 1;

        if ( $product_variation_obj->is_variation_wholesale_only == 'yes' ) {
            $min_qty_cart = $item['wholeSaleMinQty'];
        }
    @endphp
    <input wire:model="quantity" class="equipCatValidation{{$item['id']}}" type="number" min="{{$min_qty_cart}}" max="{{$product_variation_obj->variation_quantity}}" wire:change="updateCart">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script>
        $('.equipCatValidation{{$item['id']}}').on('keyup keydown change', function(e){
            if ($(this).val() > {{(isset($product_variation_obj)) ? $product_variation_obj->variation_quantity : $product_obj->product_variations}} 
                && e.keyCode !== 46
                && e.keyCode !== 8
            ) {
                e.preventDefault();     
                $(this).val({{(isset($product_variation_obj)) ? $product_variation_obj->variation_quantity : $product_obj->stocks}} );
            }
        });

        $('.equipCatValidation{{$item['id']}}').on('keyup keydown change', function(e){
            if ($(this).val() > {{(isset($product_variation_obj)) ? $product_variation_obj->variation_quantity : $product_obj->stocks}} 
                && e.keyCode !== 46
                && e.keyCode !== 8
            ) {
                e.preventDefault();     
                $(this).val({{(isset($product_variation_obj)) ? $product_variation_obj->variation_quantity : $product_obj->stocks}} );
            }
        });
    </script>
</div>
