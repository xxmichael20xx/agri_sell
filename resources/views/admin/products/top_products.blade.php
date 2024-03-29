@php
    use App\Product;
    use App\SubOrderItem;
    use Illuminate\Database\Eloquent\Collection;

    $ids = $category_id == 'all' ? [ 1, 2, 3, 4, 5, 6 ] : [ $category_id ];
    $products = Product::whereIn( 'category_id', $ids )->get();
    $collection = new Collection();
    $domain = request()->root();

    foreach ( $products as $product ) {
        $orderItems = SubOrderItem::where( 'product_id', $product->id )->groupBy( 'sub_order_id' )->get()->count();
        
        $_data = [
            'name' => $product->name,
            'value' => $orderItems,
            'bulletSettings' => [
                'src' => $domain . "/storage/" . $product->featured_image
            ]
        ];
        $data = (object) $_data;
        $collection->push( $data );
    }

    $_collections = $collection->sortByDesc( 'value' )->take( 10 )->toArray();
    $data = [];

    foreach ( $_collections as $_collection ) {
        $data[] = [
            'name' => $_collection->name,
            'value' => $_collection->value,
            'bulletSettings' => $_collection->bulletSettings,
        ];
    }

    if ( count( $data ) < 1 ) {
        $data[] = [
            'name' => 'No products',
            'value' => 0,
            'bulletSettings' => [
                'src' => $domain . "/storage/product_sample.png",
            ]
        ];
    }
@endphp

<!-- Styles -->
<style>
    #chartdiv-{{ $category_id }} {
        width: 100%;
        height: 500px;
    }
</style>

<!-- Resources -->
<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>

<!-- Chart code -->
<script>
am5.ready(function() {

// Create root element
// https://www.amcharts.com/docs/v5/getting-started/#Root_element
var root = am5.Root.new("chartdiv-{{ $category_id }}");

// Set themes
// https://www.amcharts.com/docs/v5/concepts/themes/
root.setThemes([
    am5themes_Animated.new(root)
]);

// Create chart
// https://www.amcharts.com/docs/v5/charts/xy-chart/
var chart = root.container.children.push(am5xy.XYChart.new(root, {
    panX: false,
    panY: false,
    wheelX: "none",
    wheelY: "none"
}));

// Add cursor
// https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {}));
cursor.lineY.set("visible", false);

// Create axes
// https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
var xRenderer = am5xy.AxisRendererX.new(root, { minGridDistance: 30 });

var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
    maxDeviation: 0,
    categoryField: "name",
    renderer: xRenderer,
    tooltip: am5.Tooltip.new(root, {})
}));

xRenderer.grid.template.set("visible", false);

var yRenderer = am5xy.AxisRendererY.new(root, {});
var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
    maxDeviation: 0,
    min: 0,
    extraMax: 0.1,
    renderer: yRenderer
}));

yRenderer.grid.template.setAll({
    strokeDasharray: [2, 2]
});

// Create series
// https://www.amcharts.com/docs/v5/charts/xy-chart/series/
var series = chart.series.push(am5xy.ColumnSeries.new(root, {
    name: "Series 1",
    xAxis: xAxis,
    yAxis: yAxis,
    valueYField: "value",
    sequencedInterpolation: true,
    categoryXField: "name",
    tooltip: am5.Tooltip.new(root, { dy: -25, labelText: "{valueY}" })
}));


series.columns.template.setAll({
    cornerRadiusTL: 5,
    cornerRadiusTR: 5
});

series.columns.template.adapters.add("fill", (fill, target) => {
    return chart.get("colors").getIndex(series.columns.indexOf(target));
});

series.columns.template.adapters.add("stroke", (stroke, target) => {
    return chart.get("colors").getIndex(series.columns.indexOf(target));
});

// Set data
var data = @json( $data )

series.bullets.push(function() {
    return am5.Bullet.new(root, {
    locationY: 1,
    sprite: am5.Picture.new(root, {
        templateField: "bulletSettings",
        width: 50,
        height: 50,
        centerX: am5.p50,
        centerY: am5.p50,
        shadowColor: am5.color(0x000000),
        shadowBlur: 4,
        shadowOffsetX: 4,
        shadowOffsetY: 4,
        shadowOpacity: 0.6
    })
    });
});

xAxis.data.setAll(data);
series.data.setAll(data);

// Make stuff animate on load
// https://www.amcharts.com/docs/v5/concepts/animations/
series.appear(1000);
chart.appear(1000, 100);

}); // end am5.ready()
</script>

<!-- HTML -->
<div id="chartdiv-{{ $category_id }}"></div>