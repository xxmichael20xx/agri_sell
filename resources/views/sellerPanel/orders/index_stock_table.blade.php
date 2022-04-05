<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                @if (isset($status_obj) && isset($is_pick_up))
                <h4 class="card-title">Manage {{$status_obj->display_name}} {{($is_pick_up == 'yes') ? 'Pickup' : 'Delivery'}} orders</h4>
                @endif
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
                                    Is Order Paid?
                                </th>
                                <th>
                                    Is pick up
                                </th>
                                <th>
                                    Delivery status/Pick-up status
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
                                    {{$order->order->order_number ?? 'Not available'}}
                                </td>
                                <td>
                                    {{$order->order->shipping_fullname ?? 'Not available'}}
                                </td>
                                <td>
                                    {{$order->order->grand_total ?? 'Not available'}}
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-info btn-round  dropdown-toggle" type="button"
                                        id="dropPaid{{$order->order->id ?? ''}}" data-toggle="dropdown" aria-expanded="false">
                                        @php
                                        if(isset($order->order->is_paid)){
                                            echo ($order->order->is_paid != 0) ? 'paid' : 'not paid';
                                        }
                                        @endphp
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropPaid{{$order->order->id ?? ''}}">
                                        <a class="dropdown-item"
                                            href="/seller/mark_as_paid/{{$order->order_id}}">Paid</a>
                                        <a class="dropdown-item" href="/seller/mark_as_unpaid/{{$order->order_id}}">Not
                                            Paid</a>
                                    </div>
                                    <br>
                                    {{$order->order->agcoins_transid ?? ''}}
                                </td>
                                <td>
                                    @if(isset($order->order->is_pick_up))
                                    {{($order->order->is_pick_up == 'yes') ? 'yes' : 'no'}}
                                    @endif
                                </td>
                                <td>
                                    @if(isset($order->order->is_pick_up))
                                    @if ($order->order->is_pick_up != 'yes')
                                    <button class="btn btn-sm btn-warning btn-round  dropdown-toggle" type="button"
                                        id="dropStatus{{$order->order->id ?? ''}}" data-toggle="dropdown"
                                        aria-expanded="false">
                                        {{$order->deliverystatus->display_name ?? 'Not available'}}
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropStatus{{$order->order->id ?? ''}}">
                                        @foreach ($assign_order_status_options as $option)
                                        @if ($option->name != 'notdelivery')
                                        <a class="dropdown-item"
                                            href="/edit_order_status/{{$option->id}}/{{$order->order_id}}">{{$option->display_name}}</a>
                                        @endif
                                        @endforeach
                                    </div>
                                    @else
                                    @endif
                                    @php
                                    $order_id = '';
                                    if(isset($order->order->id)){
                                        $order_id = $order->order->id;
                                    }else{
                                        $order_id = ''; 
                                    }
                                    @endphp
                                    <button class="btn btn-sm btn-warning btn-round  dropdown-toggle" type="button"
                                        id="dropStatus{{$order_id}}" data-toggle="dropdown"
                                        aria-expanded="false">
                                        {{$order->pickupstatus->display_name ?? 'Not available'}}
                                    </button>
                                    @php
                                    $assign_order_pickup_status_options = App\orderpickupStatusModel::all();
                                    @endphp

                                    <div class="dropdown-menu" aria-labelledby="dropStatus{{$order->order->id ?? ''}}">
                                        @foreach ($assign_order_pickup_status_options as $option)
                                        @if ($option->name != 'not_pickup')
                                        <a class="dropdown-item"
                                            href="/edit_pickup_status/{{$option->id}}/{{$order->order_id}}">{{$option->display_name ?? 'Not available'}}</a>
                                        @endif
                                        @endforeach
                                    </div>
                                    @endif
                                    <!--
                        N/A(Pick up)
                        {{$order->order->notes ?? ''}} -->
                                </td>
                                <td>
                                    <a class="btn btn-sm btn-primary btn-round text-white"
                                        href="/seller/order/{{$order->order_id}}">View items</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>