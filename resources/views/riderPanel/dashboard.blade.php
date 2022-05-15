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
                                <thead class="text-primary">
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
                                            Delivery status/Pick up notes
                                        </th>
                                        <th>
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach( $orders as $order )
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
                                                <button class="btn btn-sm btn-info btn-round dropdown-toggle" type="button" id="dropPaid{{ $order->order->id }}" data-toggle="dropdown" aria-expanded="false">
                                                    {{ $order->order->is_paid ? 'Paid' : 'Not Paid' }}
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropPaid{{ $order->order->id }}">
                                                    <a class="dropdown-item" href="/rider/mark_as_paid/{{ $order->order_id }}">Paid</a>
                                                    <a class="dropdown-item" href="/rider/mark_as_unpaid/{{ $order->order_id }}">Not Paid</a>
                                                </div>
                                                <br>
                                                {{ $order->order->agcoins_transid }}
                                            </td>
                                            <td>
                                                @php
                                                    $href = '#';
                                                    $action = '';
                                                    $button = '';

                                                    if ( $order->status_id == 9 ) {
                                                        $href = "/admin/edit_order_status/3/{$order->order_id}";
                                                        $button = "Pick up success";

                                                    } else if ( $order->status_id == 3 ) {
                                                        $href = "/admin/edit_order_status/4/{$order->order_id}";
                                                        $button = "On out delivery";

                                                    } else if ( $order->status_id == 4 ) {
                                                        $href = "/admin/edit_order_status/5/{$order->order_id}";
                                                        $button = "Completed";

                                                    }
                                                @endphp
                                                @if ( $button )
                                                    <button type="button" class="btn btn-primary btn-sm btn-round btn-action" data-href="{{ $href }}" data-title="{{ $button }}">{{ $button }}</button>
                                                @else
                                                    @php
                                                        $title = "No actions needed";
                                                        switch ( $order->status_id ) {
                                                            case 1:
                                                                $title = "Pending";
                                                                break;
                                                            
                                                            case 2:
                                                                $title = "Confirmed";
                                                                break;

                                                            case 3:
                                                                $title = "Order has been picked up";
                                                                break;
                                                                
                                                            default:
                                                                break;
                                                        }
                                                    @endphp
                                                    {{ $title }}
                                                    <br>
                                                @endif

                                                @if ( $order->status_id == 4 )
                                                    <button type="button" class="btn btn-danger btn-sm btn-round" data-toggle="modal" data-target="#orderModal-{{ $order->order_id }}" data-href="/admin/edit_order_status/6/{{ $order->order_id }}" data-title="Delivery failed">Delivery failed</button>

                                                    <div class="modal fade" id="orderModal-{{ $order->order_id }}">
                                                        <div class="modal-dialog">
                                                            <form method="POST" action="{{ route( 'order.delivery.update' ) }}">
                                                                <div class="modal-content">
                                                                    @csrf
                                                                    <input type="hidden" name="order_id" value="{{ $order->order_id }}">
                                                                    <input type="hidden" name="status_id" value="6">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Delivery Failed</h5>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="form-group row">
                                                                            <div class="col-12">
                                                                                <label for="reason" class="col-form-label">Reason for delivery failed</label>
                                                                                <textarea class="form-control" name="reason" id="reason" rows="5" required></textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                                        <button type="submit" class="btn btn-danger">Submit</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                @endif

                                                @if ( $order->status_id == 5 || $order->status_id == 6 )
                                                    Delivery {{ $order->status_id == 5 ? 'success' : 'failed' }}
                                                    @php
                                                        $addl_title = '';
                                                        if ( $order->status_id == 6 ) {
                                                            $addl_title = $order->order_notes . "<br>";
                                                        }
                                                    @endphp
                                                    <i class="fa fa-info-circle text-primary" data-toggle="tooltip" data-placement="top" data-html="true" title="{{ $addl_title ?? '' }}{{ AppHelpers::humanDate( $order->updated_at ) }}"></i>
                                                @endif
                                            </td>
                                            <td>
                                                <a class="btn btn-sm btn-primary btn-round text-white" href="/rider/order/{{ $order->order_id }}">View items</a>
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

@section( 'custom.scripts' )
<script>
    (function($) {
        $(document).ready(function() {
            $( document ).on( 'click', '.btn-action', function() {
                const href = $( this ).data( 'href' )
                const title = $( this ).data( 'title' )

                Swal.fire({
                    icon: 'warning',
                    title: 'Are you sure?',
                    text: `Order status will be changed to '${title}'`,
                    showCancelButton: true,
                    confirmButtonColor: '#219F94',
                    confirmButtonText: 'Yes, proceed'
                }).then( ( result ) => {
                    if ( result.value ) {
                        window.location.href = href
                    }
                } )
            } )
        })
    })(jQuery)
</script>
@endsection
