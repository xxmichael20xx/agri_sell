@extends('admin.front')
@section('content')
<style>
    .dropdown.bootstrap-select {
        width: 100% !important;
    }

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
        font-weight: 400 !important;
    }
</style>
<div class="content">
    <a href="/admin/valid_ids/" class="btn btn-outline-dark btn-round">Go back</a>

    <div class="form-group row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-8 mx-auto">
                            <img src="{{ asset('storage/' . $valid_id_user->valid_id_path) }}" alt="..." class="img-fluid mx-auto" data-toggle="modal" data-target="#imageModal">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-12 mb-2">
                            <h5 class="title text-center text-primary">{{ $valid_id_user->owner->name }}</h5>
                        </div>
                        <div class="col-12 mb-2">
                            <p class="description mb-0 text-dark text-center">
                                {{ $valid_id_user->owner->email }}
                            </p>
                        </div>
                        <div class="col-12 mb-2">
                            <p class="description mb-0 text-dark text-center">
                                {{ $valid_id_user->owner->mobile }}
                            </p>
                        </div>
                        @if ( $valid_id_user->is_valid != '2' )
                            <div class="col-12 mb-2 text-center">
                                @php
                                    $badgeType = $valid_id_user->is_valid == '1' ? 'success' : 'warning';
                                    $badgeText = $valid_id_user->is_valid == '1' ? 'Confirmed' : 'Denied';
                                @endphp
                                <h5>
                                    <div class="badge badge-{{ $badgeType }}">{{ $badgeText }}</div>
                                </h5>
                            </div>
                        @endif
                    </div>

                    <div class="form-group row">
                        <div class="col-12 text-center">
                            @if ( $valid_id_user->is_valid == '2' )
                                <button type="button" class="btn btn-outline-info btn-round m-1 action" data-action="confirm" data-href="/set_as_valid_id/{{ $valid_id_user->id }}">Confirm</button>
                                <button type="button" class="btn btn-outline-danger btn-round m-1" data-toggle="modal" data-target="#modal_not_valid">Reject</button>

                                <div class="modal fade" id="modal_not_valid" tabindex="-1" role="dialog"
                                    aria-labelledby="modal_not_validTitle" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header border-0">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Users Validation</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" id="form_invalid" action="/unset_as_valid_id/{{ $valid_id_user->id }}"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="form-group row">
                                                        <div class="col-12">
                                                            <select 
                                                                class="custom-select form-control"
                                                                name="invalid_id_reason" 
                                                                id="invalid_id_reason"
                                                                required
                                                            >
                                                                @php
                                                                    $invalid_reasons = DB::table( 'invalid_id_reasons' )->get();
                                                                @endphp
                                                                <option value="" selected disabled>Select a reason</option>
                                                                @foreach ( $invalid_reasons as $invalid_reason )
                                                                    <option value="{{ $invalid_reason->id }}">{{ $invalid_reason->display_name }}</option>
                                                                @endforeach
                                                                <option value="Others">Others</option>
                                                            </select>
                                                            <textarea class="mt-2 form-control collapse" name="invalid_id_reason_others" id="invalid_id_reason_others" rows="5" placeholder="Please provide a reason"></textarea>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer border-0">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                <button type="submit" form="form_invalid" class="btn btn-primary">Confirm</button>
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
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Additional details</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 pr-1">
                            <div class="form-group">
                                <label>Email</label>
                                <text class="form-control border-0">{{ $valid_id_user->owner->email }}</text>
                            </div>
                        </div>
                        <div class="col-md-6 pl-1">
                            <div class="form-group">
                                <label>Mobile</label>
                                <text class="form-control border-0">{{ $valid_id_user->owner->mobile }}</text>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Birth day</label>
                                <text class="form-control border-0">{{ $valid_id_user->owner->bday }}</text>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Address line/Purok</label>
                                <text class="form-control border-0">{{ $valid_id_user->owner->address }}</text>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 pr-1">
                            <div class="form-group">
                                <label>Barangay</label>
                                <text class="form-control border-0">{{ $valid_id_user->owner->barangay }}</text>
                            </div>
                        </div>
                       
                        <div class="col-md-4 pl-1">
                            <div class="form-group">
                                <label>Town/City</label>
                                <text class="form-control border-0">{{ $valid_id_user->owner->town }}</text>
                            </div>
                        </div>
                        <div class="col-md-4 px-1">
                            <div class="form-group">
                                <label>Province</label>
                                <text class="form-control border-0">{{ $valid_id_user->owner->province }}</text>
                            </div>
                        </div>
                       
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
                <img src="{{ asset( 'storage/' . $valid_id_user->valid_id_path ) }}" class="img-fluid w-100">
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
        (function($) {
            $(document).ready(function() {

                $( document ).on( 'change', '#invalid_id_reason', function() {
                    const val = $( this ).val()
                    const others = $( '#invalid_id_reason_others' )

                    if ( val == 'Others' ) {
                        others.removeClass( 'collapse' )
                        others.attr( 'required', true )

                    } else {
                        others.addClass( 'collapse' )
                        others.attr( 'required', false )
                        others.val( '' )
                    }
                } )

                $( document ).on( 'click', '.action', function() {
                    const href = $( this ).data( 'href' )
                    const action = $( this ).data( 'action' )
                    const titleFragment = ( action == 'confirm' ) ? 'Confirmed' : 'Deleted'
                    const buttonColor = ( action == 'confirm' ) ? '#51bcda' : '#dc3545'

                    Swal.fire({
                        icon: 'warning',
                        title: 'Are you sure?',
                        text: `Users ID will be ${titleFragment}!`,
                        showCancelButton: true,
                        showConfirmButton: true,
                        confirmButtonColor: buttonColor,
                        confirmButtonText: 'Confirm'
                    }).then((event) => {
                        if ( event.value ) window.location.href = href
                    })
                } )

            })
        })(jQuery)
    </script>
@endsection