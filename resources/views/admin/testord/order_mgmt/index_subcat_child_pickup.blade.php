@php
$orders = App\SubOrder::where('pick_up_status_id', $status_id)->get();
@endphp
<div class="card">
    <div class="card-header">
        <h4 class="card-title">{{$status->display_name}}</h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <div class="toolbar">
            </div>
            <table id="datatable{{$status->status_id}}" class="table " cellspacing="0" width="100%">
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
                            {{$order->order->order_number}}
                        </td>
                        <td>
                            {{$order->order->shipping_fullname}}
                        </td>
                        <td>
                            {{$order->order->grand_total}}
                        </td>
                        <td>
                            <button class="btn btn-sm btn-info btn-round  dropdown-toggle" type="button"
                                id="dropPaid{{$order->order->id}}" data-toggle="dropdown" aria-expanded="false">
                                @php
                                echo ($order->order->is_paid != 0) ? 'paid' : 'not paid';
                                @endphp
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropPaid{{$order->order->id}}">
                                <a class="dropdown-item" href="/seller/mark_as_paid/{{$order->order_id}}">Paid</a>
                                <a class="dropdown-item" href="/seller/mark_as_unpaid/{{$order->order_id}}">Not Paid</a>
                            </div>
                            <br>
                            {{$order->order->agcoins_transid}}
                        </td>
                        <td>
                            {{($order->order->is_pick_up == 'yes') ? 'yes' : 'no'}}
                        </td>
                        <td>

                            @if ($order->order->is_pick_up != 'yes')
                            <button class="btn btn-sm btn-warning btn-round  dropdown-toggle" type="button"
                                id="dropStatus{{$order->order->id}}" data-toggle="dropdown" aria-expanded="false">
                                {{$order->deliverystatus->display_name}}
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
                            <button class="btn btn-sm btn-warning btn-round  dropdown-toggle" type="button"
                                id="dropStatus{{$order->order->id}}" data-toggle="dropdown" aria-expanded="false">
                                {{$order->pickupstatus->display_name}}
                            </button>
                            @php
                            $assign_order_pickup_status_options = App\orderpickupStatusModel::all();
                            @endphp
                            <div class="dropdown-menu" aria-labelledby="dropStatus{{$order->order->id}}">
                                @foreach ($assign_order_pickup_status_options as $option)
                                @if ($option->name != 'not_pickup')

                                <a class="dropdown-item"
                                    href="/admin/edit_pickup_status/{{$option->id}}/{{$order->order_id}}">{{$option->display_name}}</a>
                                @endif
                                @endforeach
                            </div>
                            @endif
                            <!--
                        N/A(Pick up)
                        {{$order->order->notes}} -->
                        </td>
                        <td>
                            <a class="btn btn-sm btn-primary btn-round text-white"
                                href="/admin_seller/order/{{$order->order_id}}">View items</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>