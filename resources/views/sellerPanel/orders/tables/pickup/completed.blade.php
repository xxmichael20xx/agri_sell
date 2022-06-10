<table id="datatable" class="table " cellspacing="0" width="100%">
    <thead class=" text-primary">
        <tr>
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
                Date Completed
            </th>
            <th>
                Action
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ( $orders as $order )
            @php
                $method = $order->order->payment_method;
                $isPaid = $method == 'agrisell_coins' || $order->order->is_paid;

                $total = $order->order->grand_total;
                if ( $order->order->is_pick_up == 'yes' ) $total = $total - $order->order->shipping_fee;
            @endphp
            <tr>
                <td>
                    {{ $order->order->shipping_fullname ?? 'Not available' }}
                    @if ( $order->order->order_number )
                        <i class="fa fa-info-circle text-primary" data-toggle="tooltip" data-placement="top" data-html="true" title="Ref. Number:<br>{{ $order->order->order_number }}"></i>
                    @endif
                </td>
                <td>
                    ₱ {{ AppHelpers::numeric( $total ) }}
                </td>
                <td>
                    <span class="badge badge-success">Paid</span>
                </td>
                <td>
                    {{ AppHelpers::humanDate( $order->updated_at ) }}
                </td>
                <td>
                    <a class="btn btn-sm btn-primary btn-round text-white" href="/seller/order/{{$order->order_id}}">View items</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
