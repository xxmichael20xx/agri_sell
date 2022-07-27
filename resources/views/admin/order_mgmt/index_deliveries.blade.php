@extends('admin.front')
@section('content')
<style>
    .custom--dropdown-menu {
        left: unset !important;
        right: 0 !important;
    }
</style>
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-navigation">
                <div class="nav-tabs-wrapper">
                    <ul id="tabs" class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link font-weight-bold {{ $type == 'to-pick-up' ? 'active' : '' }}" href="to-pick-up">To Pick Up</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link font-weight-bold {{ $type == 'pick-up-success' ? 'active' : '' }}" href="pick-up-success">Pick Up Success</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link font-weight-bold {{ $type == 'on-out-for-delivery' ? 'active' : '' }}" href="on-out-for-delivery">On out for delivery</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link font-weight-bold {{ $type == 'completed' ? 'active' : '' }}" href="completed">Completed</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <table id="datatable" class="table" cellspacing="0" width="100%">
                        <thead class="text-primary">
                            <tr>
                                <th>
                                    Customer name
                                </th>
                                <th>
                                    Address
                                </th>
                                <th>
                                    Total
                                </th>
                                <th>
                                    Is Order Paid?
                                </th>
                                {{-- <th>
                                    Delivery status/Pick up notes
                                </th> --}}
                                <th>
                                    Action
                                </th>
                                <th>
                                    Delivery Partner
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach( $orders as $order )
                                @php
                                    $method = $order->order->payment_method;
                                    $isPaid = $method == 'agrisell_coins' || $order->order->is_paid;

                                    $_user = App\User::find( $order->order->user_id );
                                @endphp
                                <tr>
                                    <td>
                                        {{ $order->order->shipping_fullname ?? 'Not available' }}
                                        @if ( $order->order->order_number )
                                            <i class="fa fa-info-circle text-primary" data-toggle="tooltip" data-placement="top" data-html="true" title="Ref. Number:<br>{{ $order->order->order_number }}"></i>
                                        @endif
                                    </td>
                                    <td>
                                        @php
                                            if ( $_user ) {
                                                echo "{$_user->address} {$_user->barangay}, {$_user->town}";
                                            } else {
                                                echo "";
                                            }
                                        @endphp
                                    </td>
                                    <td>
                                        ₱ {{ AppHelpers::numeric( $order->order->grand_total ) }}
                                    </td>
                                    <td>
                                        @if ( $isPaid )
                                            <span class="badge badge-success">Paid</span>
                                        @else
                                            @if ( in_array( $order->status_id, array( 4, 5 ) ) )
                                                <span class="badge badge-warning">Unpaid</span>
                                            @else
                                                <span class="badge badge-warning">Unpaid</span>
                                            @endif
                                        @endif
                                        <br>
                                        {{ $order->order->agcoins_transid }}
                                    </td>
                                    {{-- <td>
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
                                                        $title = "Pending<br>";
                                                        break;
                                                    
                                                    case 2:
                                                        $title = "Confirmed<br>";
                                                        break;

                                                    case 3:
                                                        $title = "Order has been picked up<br>";
                                                        break;

                                                    case 5:
                                                    case 6:
                                                        $title = "";
                                                        break;
                                                        
                                                    default:
                                                        break;
                                                }
                                            @endphp
                                            {!! $title !!}
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
                                                                        <select name="reason" id="reason" class="custom-select" required>
                                                                            <option value="" selected disabled>Select an option</option>
                                                                            <option value="Delivery address was incorrect/incomplete">Delivery address was incorrect/incomplete</option>
                                                                            <option value="Address (shop or office) is closed ">Address (shop or office) is closed </option>
                                                                            <option value="The receiver was absent (there was no one at the address to receive the parcel)">The receiver was absent (there was no one at the address to receive the parcel)</option>
                                                                            <option value="Courier could not access the delivery location">Courier could not access the delivery location</option>
                                                                            <option value="Not finding a secure place to leave the order">Not finding a secure place to leave the order</option>
                                                                            <option value="Customer refusing to accept the delivery">Customer refusing to accept the delivery</option>
                                                                            <option value="Buyer could not be contacted">Buyer could not be contacted</option>
                                                                            <option value="Other factors cannot be controlled, such as natural disasters, epidemics, riots, and others">Other factors cannot be controlled, such as natural disasters, epidemics, riots, and others</option>
                                                                            <option value="Others">Others</option>
                                                                        </select>
                                                                        <textarea class="form-control collapse mt-2" name="reason_others" id="reason_others" rows="5" placeholder="Please provide other reasons"></textarea>
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
                                    </td> --}}
                                    <td>
                                        <a class="btn btn-sm btn-primary btn-round text-white" href="/admin_seller/order/{{ $order->order_id }}">View items</a>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton{{ $order->id }}" data-toggle="dropdown">
                                                Select a rider
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $order->id }}">
                                                @foreach ( $deliver_Staffs as $rider )
                                                    <a class="dropdown-item assign--rider-dropdown" href="#" data-id="{{ $rider->id }}" data-order-id="{{ $order->order->id }}">{{ $rider->user->name }}</a>
                                                @endforeach
                                            </div>
                                        </div>
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

<div class="modal fade" id="riderModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Assign Rider to Order</h5>
            </div>
            <div class="modal-body px-0">
                <div class="container-fluid">
                    <div class="form-group row">
                        <div class="col-12">
                            <h5>Rider Details</h5>
                            <p>Rider ID: <span id="rider_id"></span></p>
                            <p>Delivery man name: <span id="rider_name"></span></p>
                            <p>Delivery man mobile: <span id="rider_mobile"></span></p>
                            <p>Vehicle used: <span id="rider_vehicle"></span></p>
                            <p>Address: <span id="rider_address"></span></p>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-12 text-center">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-primary assign--rider">Assign</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('admin.custom_scripts')
    <script>
        const app = @json( $deliver_Staffs, JSON_PRETTY_PRINT );
        let _rider_id = null;
        let _order_id = null;

        (function($) {
            $(document).ready(function() {
                $( document ).on( 'click', '.assign--rider-dropdown', function() {
                    const id = $( this ).data( 'id' )
                    const order_id = $( this ).data( 'order-id' )
                    const rider = app.find( x => x.id == id )

                    _rider_id = id
                    _order_id = order_id
                    $( '#rider_id' ).text( rider.rider_id )
                    $( '#rider_name' ).text( rider.user.name )
                    $( '#rider_mobile' ).text( rider.user.mobile )
                    $( '#rider_vehicle' ).text( rider.vehicle_used )
                    $( '#rider_address' ).text( `${rider.user.address}, ${rider.user.barangay} ${rider.user.town}, ${rider.user.province}` )

                    $( '#riderModal' ).modal( 'show' )
                } )

                $( document ).on( 'click', '.assign--rider', function() {
                    const id = _rider_id

                    Swal.fire({
                        icon: 'info',
                        title: 'Are you sure?',
                        text: 'Rider will be assigned to deliver!',
                        showCancelButton: true,
                        showConfirmButton: true,
                        confirmButtonColor: '#dc3545',
                        confirmButtonText: 'Confirm'
                    }).then((event) => {
                        if ( event.value ) {
                            fetch( `/api/admin/order/assign-rider`, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json'
                                },
                                body: JSON.stringify( {
                                    rider_id: _rider_id,
                                    order_id: _order_id
                                } )
                            } ).then( r => r.json() ).then( res => {
                                Swal.fire({
                                    icon: res.success ? 'success' : 'info',
                                    title: res.message
                                }).then( () => {
                                    if ( res.success ) window.location.reload()
                                } )
                            } )
                        }
                    })
                } )
            })
        })(jQuery)
    </script>
@endsection