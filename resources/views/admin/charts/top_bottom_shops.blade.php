@php
    use App\Shop as AppShop;
    use App\SubOrder;
    use Illuminate\Database\Eloquent\Collection;

    $shops = AppShop::where( 'is_active', 1 )->get();
    $collection = new Collection();

    foreach ( $shops as $shop_index => $shop ) {
        if ( ! $shop->owner ) continue;
        $order_count = SubOrder::where( 'seller_id', $shop->owner->id )->count();
        $_data = [
            'name' => $shop->name,
            'order' => $order_count ?? 0
        ];

        $data = ( object ) $_data;
        $collection->push( $data );
    }

    $collection = $collection->sortByDesc( 'order' );
    $collection = $collection->take( 10 );

    $labels = $collection->pluck( 'name' );
    $data = $collection->pluck( 'order' );
@endphp

<canvas id="chart_top_bottom"></canvas>

<script>
    const ctx_top_bottom = document.getElementById( 'chart_top_bottom' ).getContext( '2d' )
    const chart_top_bottom = new Chart( ctx_top_bottom, {
        type: 'bar',
        data: {
            datasets: [
                {
                    label: 'Top-Bottom Shops',
                    data: {{ $data }},
                }
            ],
            labels: {!! $labels !!}
        },
        options: {
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(255, 205, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(201, 203, 207, 0.2)'
            ],
            borderColor: [
                'rgb(255, 99, 132)',
                'rgb(255, 159, 64)',
                'rgb(255, 205, 86)',
                'rgb(75, 192, 192)',
                'rgb(54, 162, 235)',
                'rgb(153, 102, 255)',
                'rgb(201, 203, 207)'
            ],
            borderWidth: 1,
            barThickness: 100,
        },
    } )
</script>
