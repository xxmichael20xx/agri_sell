@php
    $order_items = App\OrderItem::all();
    $categories = App\Category::all();
    $categories_str = "";
    $chart_data_str = "";
    $categories_arr = array();
    $categories_total = array();
    $category_counter_tmp = 0;
    foreach($categories as $category){
        $categories_str .= "'" . $category->name . "'" . ", ";
        array_push($categories_arr, $category->id);
        array_push($categories_total, 0);
    }
    foreach($order_items as $order_item){
        $index_cat_tmp = $order_item->productCategory->category->id - 1;
        $categories_total[$index_cat_tmp] += $order_item->quantity;
    }
    foreach($categories_total as $categories_total_item){
        $chart_data_str .= $categories_total_item  . ", ";
    }


@endphp
@foreach($order_items as $order_item)

    {{-- $order_item->productCategory->category->name --}}
        {{-- $order_item->quantity --}}

@endforeach
<canvas id="chart_sales_by_cat"></canvas>

<script>
    const ctx = document.getElementById('chart_sales_by_cat').getContext('2d');
    const chart_sales_by_cat = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: [@php 
            echo $categories_str;
            @endphp],
            datasets: [{
                label: '# of orders',
                data: [@php
                    echo $chart_data_str;
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
