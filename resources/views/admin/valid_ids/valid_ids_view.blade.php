@extends('admin.front')
@section('content')
<style>
    .dropdown.bootstrap-select {
        width: 100% !important;
    }
</style>
<div class="content">
    <a href="/admin/valid_ids/" class="btn btn-outline-dark btn-round m-1">Go back</a>

    <div class="form-group row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Valid id</h5>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-6 mx-auto">
                            <img src="{{ asset('storage/'.$valid_id_user->valid_id_path ) }}" class="img-fluid w-100">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-12 mb-3">
                            <span class="text-muted ">Name: {{ $valid_id_user->owner->name }}</span>
                        </div>
                        <div class="col-12 mb-3">
                            <span class="text-muted "><span class="text-muted">Address: {{ $valid_id_user->owner->address }} {{ $valid_id_user->owner->barangay }} {{ $valid_id_user->owner->town }} {{ $valid_id_user->owner->province }}</span></span>
                        </div>
                        <div class="col-12 mb-3">
                            <span class="text-muted">Birthday: {{ $valid_id_user->owner->bday }}</span>
                        </div>
                        @if ( $valid_id_user->is_valid != '2' )
                            <div class="col-12 mb-3">
                                <span class="text-muted">Validity: {{ $valid_id_user->is_valid == '1' ? 'Valid' : 'Invalid' }}</span>
                            </div>
                        @endif
                        <div class="col-12">
                            @if ( $valid_id_user->is_valid == '2' )
                                <a href="/set_as_valid_id/{{ $valid_id_user->id }}" class="btn btn-outline-success btn-round m-1">Mark as valid</a>
                                <a class="btn btn-outline-danger btn-round m-1 text-danger" data-toggle="modal" data-target="#modal_not_valid">Mark as not valid</a>
                                <div class="modal fade" id="modal_not_valid" tabindex="-1" role="dialog"
                                    aria-labelledby="modal_not_validTitle" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header border-0">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Reason for not valid</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" id="form_invalid" action="/unset_as_valid_id/{{ $valid_id_user->id }}"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="dropdown bootstrap-select">
                                                        <select 
                                                            class="selectpicker"
                                                            data-style="btn btn-primary btn-round" 
                                                            name="invalid_id_reason" 
                                                            title="Select reason"
                                                            required
                                                        >
                                                            @php
                                                                $invalid_reasons = DB::table('invalid_id_reasons')->get();
                                                            @endphp
                                                            @foreach ($invalid_reasons as $invalid_reason)
                                                                <option value="{{$invalid_reason->id}}">{{$invalid_reason->display_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer border-0">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                <button type="submit" form="form_invalid" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                @if ( $valid_id_user->is_valid == '0' )
                                <button class="btn btn-outline-danger btn-round m-1 text-danger action" data-href="/admin/delete_valid_id/{{ $valid_id_user->id }}">Delete</button>
                                @endif
                            @endif
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
        (function($) {
            $(document).ready(function() {

                $( document ).on( 'click', '.action', function() {
                    const href = $( this ).data( 'href' )

                    Swal.fire({
                        icon: 'warning',
                        title: 'Are you sure?',
                        text: `User ID Request will be deleted! This can't be undone!`,
                        showCancelButton: true,
                        showConfirmButton: true,
                        confirmButtonColor: '#dc3545',
                        confirmButtonText: 'Confirm'
                    }).then((event) => {
                        if ( event.value ) window.location.href = href
                    })
                } )

            })
        })(jQuery)
    </script>
@endsection