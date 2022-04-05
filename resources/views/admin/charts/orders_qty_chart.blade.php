@php
    $cat_date_str_a = "";
    $data_qty_str_a = "";
    $ordered_products_by_date = DB::select("SELECT CONCAT(MONTHNAME(created_at), '-', YEAR(created_at)) AS ForMonth,DATE(created_at) AS ForDate, SUM(item_count) AS numProducts FROM sub_orders  GROUP BY DATE(created_at) ORDER BY ForDate");

    foreach ($ordered_products_by_date as $qty_by_date_obj){
    $cat_date_str_a .= "'" . $qty_by_date_obj->ForDate . "'" . ", ";
    $data_qty_str_a .= $qty_by_date_obj->numProducts  . ", ";
    }

@endphp
<canvas id="orders_by_date_chrt"></canvas>

<script>
    const ctx_orders = document.getElementById('orders_by_date_chrt').getContext('2d');
    const orders_by_date_chrt = new Chart(ctx_orders, {
        type: 'line',
        data: {
            labels: [@php
                echo $cat_date_str_a;
            @endphp],
            parsing: false,
            datasets: [{
                label: 'orders qty',
                data: [@php
                    echo $data_qty_str_a;
                @endphp],
                fill: true,
                border: false,
                backgroundColor: 'rgb(255, 99, 132)',
            }]
        },


    });

</script>
