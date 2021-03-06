@extends('admin.front')
@section('content')
@php
    use App\User;
@endphp
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.0/jspdf.umd.min.js"></script>
<script src="https://unpkg.com/jspdf@latest/dist/jspdf.umd.min.js"></script>


<div class="content">
    <div class="row">
        {{-- <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-body ">
                    <div class="row">
                        <div class="col-5 col-md-4">
                            <div class="icon-big text-center icon-warning">
                                <i class="nc-icon nc-box text-warning"></i>
                            </div>
                        </div>
                        <div class="col-7 col-md-8">
                            <div class="numbers">
                             
                                <p class="card-category">Total orders</p>
                                <p class="card-title">{{ $total_order_qty }}<p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer ">
                    <hr>
                    <div class="stats">
                        <i class="fa fa-info"></i>
                        Total orders
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-body ">
                    <div class="row">
                        <div class="col-5 col-md-4">
                            <div class="icon-big text-center icon-warning">
                                <i class="nc-icon nc-money-coins text-success"></i>
                            </div>
                        </div>
                        <div class="col-7 col-md-8">
                            <div class="numbers">
                                <p class="card-category">Shipping costs</p>
                                <p class="card-title">{{ $total_revenue_by_shipping_fee }}<p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer ">
                    <hr>
                    <div class="stats">
                        <i class="fa fa-bandcamp"></i>
                        Total shipping costs
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats card--links clickable" data-href="/admin/manage_shops">
                <div class="card-body ">
                    <div class="row">
                        <div class="col-5 col-md-4">
                            <div class="icon-big text-center icon-warning">
                                <i class="nc-icon nc-shop text-danger"></i>
                            </div>
                        </div>
                        <div class="col-7 col-md-8">
                            <div class="numbers">
                                <p class="card-category">Shops</p>
                                <p class="card-title">{{ $shop_count }}<p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer ">
                    <hr>
                    <div class="stats">
                        <i class="fa fa-shopping-bag"></i>
                        Total Shop count
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats card--links clickable" data-href="/admin/manage_users">
                <div class="card-body ">
                    <div class="row">
                        <div class="col-5 col-md-4">
                            <div class="icon-big text-center icon-warning">
                                <i class="nc-icon nc-single-02 text-primary"></i>
                            </div>
                        </div>
                        <div class="col-7 col-md-8">
                            <div class="numbers">
                                <p class="card-category">Accounts</p>
                                <p class="card-title">{{ $buyer_acc_count }}<p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer ">
                    <hr>
                    <div class="stats">
                        <i class="fa fa-info"></i>
                        Total user accounts
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats card--links clickable" data-href="/admin/rider_management">
                <div class="card-body ">
                    <div class="row">
                        <div class="col-5 col-md-4">
                            <div class="icon-big text-center icon-warning">
                                <i class="nc-icon nc-single-02 text-primary"></i>
                            </div>
                        </div>
                        <div class="col-7 col-md-8">
                            <div class="numbers">
                                <p class="card-category">Delivery staff</p>
                                <p class="card-title">{{ $rider_acc_count }}<p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer ">
                    <hr>
                    <div class="stats">
                        <i class="fa fa-user-circle-o"></i>
                        Number of delivery staff
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-body ">
                    <div class="row">
                        <div class="col-5 col-md-4">
                            <div class="icon-big text-center icon-warning">
                                <i class="nc-icon nc-money-coins text-warning"></i>
                            </div>
                        </div>
                        <div class="col-7 col-md-8">
                            <div class="numbers">
                                <p class="card-category">Agri coins</p>
                                <p class="card-title">{{ $ag_coins_topped_up_total }}<p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer ">
                    <hr>
                    <div class="stats">
                        <i class="fa fa-database"></i>
                        Total agri coins topped up
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats card--links clickable" data-href="/admin/manage_products">
                <div class="card-body ">
                    <div class="row">
                        <div class="col-5 col-md-4">
                            <div class="icon-big text-center icon-warning">
                                <i class="nc-icon nc-box-2 text-success"></i>
                            </div>
                        </div>
                        <div class="col-7 col-md-8">
                            <div class="numbers">
                                <p class="card-category">Products</p>
                                <p class="card-title">{{ $product_count }}<p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer ">
                    <hr>
                    <div class="stats">
                        <i class="fa fa-refresh"></i>
                        Total products
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-body ">
                    <div class="row">
                        <div class="col-5 col-md-4">
                            <div class="icon-big text-center icon-warning">
                                <i class="nc-icon nc-box-2 text-success"></i>
                            </div>
                        </div>
                        <div class="col-7 col-md-8">
                            <div class="numbers">
                                <p class="card-category">Order qty</p>
                                <p class="card-title">{{ $order_qty_total }}<p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer ">
                    <hr>
                    <div class="stats">
                        <i class="fa fa-refresh"></i>
                        Total ordered product qty
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4 class="card-title">Activity Logs</h4>
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="report--activity-logs" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Report Generation
                        </button>
                        <div class="dropdown-menu">
                            @php
                                $inc = [
                                    'type' => 'admin_activities',
                                    'key' => 'admin_activities' . rand( 50, 1000 ),
                                    'title' => 'Activity Log',
                                    'reports' => [
                                        [
                                            'href' => '/export/csv/activity-logs',
                                            'label' => 'CSV',
                                        ],
                                        [
                                            'href' => '/export/pdf/activity-logs',
                                            'label' => 'PDF',
                                        ],
                                    ],
                                ];
                            @endphp
                            @include( 'admin.export.modal_trigger', $inc )
                        </div>
                    </div>
                    @include( 'admin.export.modal_content', $inc )
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable1" class="table " cellspacing="0" width="100%">
                            <thead class=" text-primary">
                                <tr>
                                    <th>
                                    Action type
                                    </th>
                                    <th>
                                        Decription
                                    </th>
                                    <th>
                                        User account name
                                    </th>
                                    <th>
                                        Created at
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ( $notifs as $notif )
                                    @php
                                        $action = $notif->action_type;

                                        if ( $action == 'User regisration' ) {
                                            $content = explode( ':', $notif->action_description );
                                            $email = $content[1];
                                            $tempUser = User::where( 'email', $email )->first();
                                        }
                                    @endphp
                                    <tr>
                                        <td>
                                            {{ $notif->action_type }}
                                        </td>
                                        <td>
                                            {!! $notif->action_description !!}
                                        </td>
                                        <td>
                                            @php
                                                if ( $action == 'User regisration' && $tempUser ) {
                                                    echo $tempUser->name;
                                                } else {
                                                    echo $notif->user->name ?? '';
                                                }
                                            @endphp
                                        </td>
                                        <td>
                                            {{ $notif->created_at }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-header">
                    Orders by date
                </div>
                <div class="card-body">
                    @include('admin.charts.orders_qty_chart')
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-header">
                    Products by category
                </div>
                <div class="card-body">
                    @include('admin.charts.products_by_category')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('admin.custom_scripts')
<script>
    (function($) {
        $(document).ready(function() {
            $( document ).on( 'click', '.card--links', function() {
                const href = $( this ).data( 'href' )

                window.location.href = href
            } )
        })
    })(jQuery)
</script>
@endsection
