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
                if ( $order->order->is_paid || $order->order->payment_method == 'agrisell_coins' ) $paidData = array( 'Paid', 'success' );

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
                    <span class="badge badge-{{ $paidData[1] }}">{{ $paidData[0] }}</span>
                    {{ $order->order->agcoins_transid ?? '' }}
                </td>
                <td>
                    <button type="button" class="btn btn-primary btn-sm btn-round btn-pickup" data-href="/edit_pickup_status/5/{{ $order->order_id }}" data-title="Completed">Complete</button>
                    <button type="button" class="btn btn-danger btn-sm btn-round" data-toggle="modal" data-target="#orderCancel-{{ $order->order_id }}">Cancel</button>
                    
                    <div class="modal fade" id="orderCancel-{{ $order->order_id }}">
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
                                                <select class="custom-select" name="cancel_reason" id="cancel_reason" required>
                                                    <option value="" selected disabled>Select a reason</option>
                                                    <option value="Seller can't ship the item.">Seller can't ship the item.</option>
                                                    <option value="Rider din't pick up the item.">Rider din't pick up the item.</option>
                                                    <option value="Others">Others</option>
                                                </select>
                                                <textarea class="form-control mt-2 collapse" name="cancel_reason_others" id="cancel_reason_others" rows="5" placeholder="Please provide a reason"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-danger">Cancel order</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </td>
                <td>
                    <a class="btn btn-sm btn-primary btn-round text-white" href="/seller/order/{{$order->order_id}}">View items</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>