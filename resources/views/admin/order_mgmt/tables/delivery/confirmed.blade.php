<table id="datatable" class="table " cellspacing="0" width="100%">
    <thead class=" text-primary">
        <tr>
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
                Delivery status/Pick-up status
            </th>
            <th>
                Action
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($orders as $order)
            @php
                $order_id = '';
                $paidData = array( 'Not Paid', 'warning' );
                
                if ( isset($order->order->id ) ) $order_id = $order->order->id;
                if ( $order->order->is_paid ) $paidData = array( 'Paid', 'success' );
            @endphp
            <tr>
                <td>
                    {{ $order->order->shipping_fullname ?? 'Not available' }}
                    @if ( $order->order->order_number )
                        <i class="fa fa-info-circle text-primary" data-toggle="tooltip" data-placement="top" data-html="true" title="Ref. Number:<br>{{ $order->order->order_number }}"></i>
                    @endif
                </td>
                <td>
                    {{ AppHelpers::numeric( $order->order->grand_total ) }}
                </td>
                <td>
                    <span class="badge badge-{{ $paidData[1] }}">{{ $paidData[0] }}</span>
                    {{ $order->order->agcoins_transid ?? '' }}
                </td>
                <td>
                    <button type="button" class="btn btn-primary btn-sm btn-round btn-delivery" data-href="/edit_order_status/9/{{ $order->order_id }}" data-title="Ready to Pick up">Set to Pick up</button>
                </td>
                <td>
                    <a class="btn btn-sm btn-primary btn-round" href="/admin_seller/order/{{ $order->order_id }}">View items</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>