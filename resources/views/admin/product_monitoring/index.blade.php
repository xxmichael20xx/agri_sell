@extends('admin.front')
@section('content')
<div class="content">
    <div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3>Order monitoring</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div class="toolbar">
                    </div>
                    <table id="datatable" class="table " cellspacing="0" width="100%">
                        <thead class=" text-primary">
                            <tr>
                                <th>
                                    Order ref num
                                </th>
                                <th>
                                    Customer name
                                </th>
                                <th>
                                    Grand total
                                </th>
                              
                                <th>
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                            <tr>
                                <td>
                                    {{$order->order->order_number ?? 'not available'}}
                                </td>
                                <td>
                                    {{$order->order->shipping_fullname ?? 'not available'}}
                                </td>
                                <td>
                                    {{$order->order->grand_total ?? 'not available'}}
                                </td>
                               
                               
                                <td>
                                    <a class="btn btn-sm btn-primary btn-round text-white"
                                        href="/admin_product_monitor/products/{{$order->order_id}}">Monitor products</a>
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
@endsection