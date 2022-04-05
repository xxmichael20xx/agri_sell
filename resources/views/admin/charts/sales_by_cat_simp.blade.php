@php

@endphp
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
