@extends('admin.front')
@section('content')
@php
    use App\User;
    $user_obj = User::find( $user->user_id );
    $badgeType = "info";
    $badgeText = "Pending";

    if ( $user->status == 1 ) {
        $badgeType = "info";
        $badgeText = "Valid";

    } else {
        $badgeType = "warning";
        $badgeText = "Invalid";
    }
@endphp
<style>
    .btn-outline-danger {
        color: #dc3545 !important;
        border-color: #dc3545 !important;
    }

    .btn-outline-danger:hover {
        color: #fff !important;
        background-color: #dc3545 !important;
        border-color: #dc3545 !important;
    }

    .description {
        font-weight: 400
    }
</style>

<div class="content">
    <a href="/admin/sell_reg_fees" class="btn btn-outline-dark btn-round">Go back</a>
    <div class="form-group row">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Seller Registration Fee Details</h5>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-8 mx-auto">
                            <img src="{{ asset( 'storage/' . $user->payment_proof ) }}" alt="..." class="img-fluid mx-auto" data-toggle="modal" data-target="#imageModal">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-12 mb-2">
                            <h6 class="mb-0 text-dark">Shop details</h6>
                        </div>
                        <div class="col-12 mb-2">
                            <p class="description mb-0 text-dark">
                                Shop name: {{ $user_obj->shop->name }}
                            </p>
                        </div>
                        <div class="col-12 mb-2">
                            <p class="description mb-0 text-dark">
                                Shop description: {{ $user_obj->shop->description }}
                            </p>
                        </div>
                        <div class="col-12 mb-2 mt-4">
                            <h6 class="mb-0 text-dark">Payment details</h6>
                        </div>
                        <div class="col-12 mb-2">
                            <p class="description mb-0 text-dark">
                                Name: {{ $user_obj->name }}
                            </p>
                        </div>
                        <div class="col-12 mb-2">
                            <p class="description mb-0 text-dark">
                                Address: {{ $user_obj->address }} {{ $user_obj->barangay }} {{ $user_obj->town }} {{ $user_obj->province }}
                            </p>
                        </div>
                        @if ( $user->status !== '0' )
                            <h5>
                                <div class="badge badge-{{ $badgeType }}">{{ $badgeText }}</div>
                            </h5>
                            
                        @else
                            <div class="col-12 text-center">
                                <button type="button" class="btn btn-outline-info btn-round m-1 action" data-action="valid" data-href="/admin/sell_reg_approved/{{ $user->id }}">Valid</button>
                                <button type="button" class="btn btn-outline-danger btn-round m-1" data-toggle="modal" data-target="#invalidModal{{ $user->id }}">Invalid</button>

                                <div class="modal fade" id="invalidModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="invalidModalTitle" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Seller Registration - Invalid</h5>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" id="set_invalid_reason_form{{ $user->id }}" action="/invalid_sell_reg_status_remarks" class="col-12">
                                                    @csrf
                                                    @method('POST')
                                                    <div class="form-group row py-4">
                                                        <div class="col-12">
                                                            <input type="hidden" name="sell_reg_id" value="{{ $user->id }}">
                                                            <select name="invalid_sell_reg_status" id="invalid_sell_reg_status" class="custom-select form-control" required>
                                                                <option value="" selected disabled>Select an option</option>
                                                                @php
                                                                    $option_list = DB::table( 'invalid_sell_reg_reasons' )->get();
                                                                    $exclude = [
                                                                        'not_init', 'not_payment_form', 'fake_payment_form'
                                                                    ];
                                                                @endphp
                                                                @foreach( $option_list as $inst_options )
                                                                    @if ( ! in_array( $inst_options->name, $exclude ) )
                                                                        <option value="{{ $inst_options->name }}">{{ $inst_options->slug }}</option>
                                                                    @endif
                                                                @endforeach
                                                                <option value="Others">Others</option>
                                                            </select>
                                                            <textarea class="mt-2 form-control collapse" name="invalid_sell_reg_status_others" id="invalid_sell_reg_status_others" rows="5" placeholder="Please provide a reason"></textarea>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" form="set_invalid_reason_form{{$user->id}}" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="imageModal">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-body">
                <img src="{{ asset( 'storage/' . $user->payment_proof ) }}" class="img-fluid w-100">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('admin.custom_scripts')
    <script>
        ( function( $ ) {

            $( document ).ready( function() {

                $( document ).on( 'click', '.action', function() {
                    const href = $( this ).data( 'href' )
                    const action = $( this ).data( 'action' )
                    const titleFragment = ( action == 'valid' ) ? 'Valid' : 'Invalid'
                    const buttonColor = ( action == 'valid' ) ? '#51bcda' : '#dc3545'

                    Swal.fire({
                        icon: 'warning',
                        title: 'Are you sure?',
                        text: `Seller Registration will be marked as ${titleFragment}!`,
                        showCancelButton: true,
                        showConfirmButton: true,
                        confirmButtonColor: buttonColor,
                        confirmButtonText: 'Confirm'
                    }).then((event) => {
                        if ( event.value ) window.location.href = href
                    })
                } )

                $( document ).on( 'change', '#invalid_sell_reg_status', function() {
                    const val = $( this ).val()
                    const others = $( '#invalid_sell_reg_status_others' )

                    if ( val == 'Others' ) {
                        others.removeClass( 'collapse' )
                        others.attr( 'required', true )

                    } else {
                        others.addClass( 'collapse' )
                        others.attr( 'required', false )
                        others.val( '' )
                    }
                } )

            } )

        } )( jQuery )
    </script>
@endsection