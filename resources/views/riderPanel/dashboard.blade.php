@extends('riderPanel.front')
@section('content')

    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Manage Order delivery  {{Auth::user()->rider_staff->rider_id ?? 'not available'}}</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="toolbar">
                                <!--        Here you can write extra buttons/actions for the toolbar              -->
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
                                        Total
                                    </th>
                                    <th>
                                        Is Order Paid?
                                    </th>
                                    <th>
                                        Delivery status/Pick up notes
                                    </th>
                                    <th>
                                        Action
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($orders as $order)
                                            @if ($order->order->is_pick_up != 'yes')         
                                            <tr>
                                                <td>
                                                    <br>
                                                    {{$order->order->order_number}}
                                                </td>
                                                <td>
                                                    {{$order->order->shipping_fullname}}
                                                </td>
                                                <td>
                                                    {{$order->order->grand_total}}
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-info btn-round  dropdown-toggle"
                                                            type="button" id="dropPaid{{$order->order->id}}"
                                                            data-toggle="dropdown" aria-expanded="false">
                                                        @php
                                                            echo ($order->order->is_paid != 0) ? 'paid' : 'not paid';
                                                        @endphp
                                                    </button>
                                                    <div class="dropdown-menu"
                                                         aria-labelledby="dropPaid{{$order->order->id}}">
                                                        <a class="dropdown-item" href="/rider/mark_as_paid/{{$order->order_id}}">Paid</a>
                                                        <a class="dropdown-item" href="/rider/mark_as_unpaid/{{$order->order_id}}">Not Paid</a>
                                                    </div>
                                                    <br>
                                                    {{$order->order->agcoins_transid}}
                                                </td>
                                                <td>
                                                    @if ($order->order->is_pick_up != 'yes')
                                                        <button
                                                            class="btn btn-sm btn-warning btn-round  dropdown-toggle"
                                                            type="button" id="dropStatus{{$order->order->id}}"
                                                            data-toggle="dropdown" aria-expanded="false">
                                                            {{$order->deliverystatus->display_name ?? 'unavailable'}}
                                                        </button>
                                                    
                                                        <div class="dropdown-menu" aria-labelledby="dropStatus{{$order->order->id}}">
                                                            @foreach ($assign_order_status_options as $option)
                                                            @if ($option->name != 'notdelivery')
                                                            <a class="dropdown-item"
                                                                href="/admin/edit_order_status/{{$option->id}}/{{$order->order_id}}">{{$option->display_name}}</a>
                                                            @endif
                                                            @endforeach
                                                        </div>
                                                    @else
                                                        {{$order->order->notes}}
                                                    @endif
                                                </td>
                                                <td>
                                                    <a class="btn btn-sm btn-primary btn-round text-white"
                                                       href="/rider/order/{{$order->order_id}}">View items</a>
                                                </td>
                                            </tr>
                                            @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
