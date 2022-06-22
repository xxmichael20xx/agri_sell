@extends('admin.front')
@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.0/jspdf.umd.min.js"></script>
<script src="https://unpkg.com/jspdf@latest/dist/jspdf.umd.min.js"></script>


<div class="content">
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
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
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
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
            <div class="card card-stats">
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
            <div class="card card-stats">
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
        <div class="col-lg-3 col-md-6 col-sm-6">
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
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
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
        <div class="col-lg-3 col-md-6 col-sm-6">
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
        </div>
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
                        <a class="dropdown-item" href="/export/csv/activity-logs" target="_blank">Excel</a>
                    </div>
                </div>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                <table id="datatable1" class="table " cellspacing="0" width="100%">
                    <thead class=" text-primary">
                      <tr><th>
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
                    </tr></thead>
                    <tbody>
                        @foreach ($notifs as $notif)
                        <tr>
                        <td>
                        {{$notif->action_type }}
                        </td>
                        <td>
                        {!! $notif->action_description !!}
                        </td>
                        <td>
                        {{$notif->user->name ?? 'not available'}}
                        </td>
                        <td>
                        {{$notif->created_at}}
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
            $( document ).on( 'click', '.btn-report', function() {
                const type = $( this ).data( 'type' )


            } )
        })
    })(jQuery)
</script>
@endsection
