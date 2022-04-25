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
        @foreach ( $orders as $order )
            @php
                $order_id = '';
                $isModal = '';
                $modelId = '';
                $inIds = array( $status_id );
                $paidData = array( 'Not Paid', 'warning' );
                
                if ( isset($order->order->id ) ) $order_id = $order->order->id;
                if ( $status_id == 1 ) $inIds = array( $inIds, 3 );
                if ( $order->order->is_paid ) $paidData = array( 'Paid', 'success' );
                $assign_order_pickup_status_options = App\orderpickupStatusModel::whereIn( 'status_id', $inIds )->get();
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
                    <button class="btn btn-sm btn-warning btn-round  dropdown-toggle" type="button"
                        id="dropStatus{{ $order_id }}" data-toggle="dropdown"
                        aria-expanded="false">
                        {{$order->pickupstatus->display_name ?? 'Not available'}}
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropStatus{{ $order->order->id ?? '' }}">
                        @foreach ($assign_order_pickup_status_options as $option)
                            @if ( AppHelpers::filterStatus( $option, $status_id ) )
                                @php
                                    $isModal = "";
                                    $href = "/edit_pickup_status/{$option->id}/{$order->order_id}";

                                    if ( $option->name == 'cancelled' ) {
                                        if ( ! $isModal ) {
                                            $isModal = "modal";
                                            $modelId = 3;
                                        }
                                        $href = "#cancelOrderModal-{$order->order_id}";
                                    }
                                @endphp
                                @if ( $isModal )
                                    <a 
                                        class="dropdown-item"
                                        href="{{ $href }}"
                                        data-toggle="modal"
                                    >
                                        {{ $option->name == 'cancelled' ? 'Cancel order' : $option->display_name }}
                                    </a>
                                @else
                                    <a 
                                        class="dropdown-item btn-confirm clickable"
                                        data-href="{{ $href }}"
                                        data-title="Confirmed"
                                    >
                                        {{ $option->display_name }}
                                    </a>
                                @endif
                            @endif
                        @endforeach
                    </div>

                    @foreach ($assign_order_pickup_status_options as $option)
                        @if ( AppHelpers::filterStatus( $option, $status_id ) && $option->name == 'cancelled' )
                            <div class="modal fade" id="cancelOrderModal-{{ $order->order_id }}">
                                <div class="modal-dialog">
                                    <form method="POST" action="{{ route( 'order.order.update' ) }}">
                                        <div class="modal-content">
                                            @csrf
                                            <input type="hidden" name="order_id" value="{{ $order->order_id }}">
                                            <input type="hidden" name="status_id" value="3">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Cancel Order</h5>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group row">
                                                    <div class="col-12">
                                                        <label for="cancel_reason" class="col-form-label">Reason for cancelling</label>
                                                        <textarea class="form-control" name="cancel_reason" id="cancel_reason" rows="5" required></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-success">Cancel order</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </td>
                <td>
                    <a class="btn btn-sm btn-primary btn-round text-white" href="/seller/order/{{ $order->order_id }}">View items</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
