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
                Reason
            </th>
            <th>
                Action
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ( $orders as $order )
            <tr>
                <td>
                    {{ $order->order->shipping_fullname ?? 'Not available' }}
                    @if ( $order->order->order_number )
                        <i class="fa fa-info-circle text-primary" data-toggle="tooltip" data-placement="top" data-html="true" title="Ref. Number:<br>{{ $order->order->order_number }}"></i>
                    @endif
                </td>
                <td>
                    ₱ {{ AppHelpers::numeric( $order->order->grand_total ) }}
                </td>
                <td>
                    {{ $order->order_notes }}
                    <i class="fa fa-info-circle text-primary" data-toggle="tooltip" data-placement="top" data-html="true" title="Delivery failed: <br>{{ AppHelpers::humanDate( $order->updated_at ) }}"></i>
                </td>
                <td>
                    <a class="btn btn-sm btn-primary btn-round text-white" href="/seller/order/{{$order->order_id}}">View items</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>