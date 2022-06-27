@php
    $cat_date_str = "";
    $data_qty_str = "";
    $ordered_products_by_date = DB::select("SELECT CONCAT(MONTHNAME(created_at), '-', YEAR(created_at)) AS ForMonth,DATE(created_at) AS ForDate, SUM(item_count) AS numProducts FROM sub_orders WHERE seller_id = " .Auth::user()->id." GROUP BY DATE(created_at) ORDER BY ForDate");
    
    foreach ( $ordered_products_by_date as $qty_by_date_obj ) {
        $cat_date_str .= "'" . $qty_by_date_obj->ForDate . "'" . ", ";
        $data_qty_str .= $qty_by_date_obj->numProducts  . ", ";
    }
@endphp
<canvas id="chart_prods_by_cat"></canvas>

<script>
    const ctx_prods = document.getElementById('chart_prods_by_cat').getContext('2d');
    const chart_prods_by_cat = new Chart(ctx_prods, {
        type: 'line',
        data: {
            labels: [@php 
            echo $cat_date_str;
            @endphp],
            parsing: false,
            datasets: [{
                label: 'orders qty',
                data: [@php
                    echo $data_qty_str;
                @endphp],
                fill: true,
                border: false,
                backgroundColor: 'rgb(255, 99, 132)',
            }]
        },
    });
</script>
