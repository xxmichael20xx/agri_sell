@php
    $order_items_prods = App\OrderItem::all();
    $productCategory_prods = App\ProductCategory::all();
    $categories_prods = App\Category::all();
    $categories_prods_str = "";
    $chart_data_str_prods = "";
    $categories_prods_arr = array();
    $categories_prods_total = array();
    $category_counter_tmp_prods = 0;
    foreach($categories_prods as $category){
        $categories_prods_str .= "'" . $category->name . "'" . ", ";
        array_push($categories_prods_arr, $category->id);
        array_push($categories_prods_total, 0);
    }
    foreach($productCategory_prods as $product_categories_prods){
        $index_cat_tmp = $product_categories_prods->category_id - 1;
        $categories_prods_total[$index_cat_tmp] += 1;
    }

    foreach($categories_prods_total as $categories_prods_total_item){
        $chart_data_str_prods .= $categories_prods_total_item  . ", ";
    }

@endphp

<canvas id="chart_prods_by_cat"></canvas>

<script>
    const ctx_prods = document.getElementById('chart_prods_by_cat').getContext('2d');
    const chart_prods_by_cat = new Chart(ctx_prods, {
        type: 'pie',
        data: {
            labels: [@php 
            echo $categories_prods_str;
            @endphp],
            datasets: [{
                label: '# of orders',
                data: [@php
                    echo $chart_data_str_prods;
                @endphp],
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)',
                    '#2F86A6',

                ],

            }]
        },

    });

</script>
