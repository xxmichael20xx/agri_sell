@extends('admin.front')
@section('content')
<style>
    .dropdown.bootstrap-select {
        width: 100% !important;
    }
</style>
<div class="content">
    <a href="/admin/valid_ids/" class="btn btn-outline-dark btn-round m-1">Go back</a>

    <div class="row">
        <div class="col-md-8">
            <div class="card card-plain">
                <div class="card-header">
                    <h5 class="card-title">Valid id</h5>
                </div>
                <div class="card-body">
                    <img src="{{ asset('storage/'.$valid_id_user->valid_id_path ) }}">
                    <br>
                    <div class="mt-5"></div>
                    <span class="text-muted ">Name: {{ $valid_id_user->owner->name }}</span>
                    <br>
                    <span class="text-muted">Address: {{ $valid_id_user->owner->address }} {{ $valid_id_user->owner->barangay }} {{ $valid_id_user->owner->town }} {{ $valid_id_user->owner->province }}</span>
                    <br>
                    <span class="text-muted">Birthday: {{ $valid_id_user->owner->bday }}</span>
                    <br>
                    <span class="text-muted">Validity:
                        @if ($valid_id_user->is_valid == '1')
                            valid
                        @else
                            invalid
                            @php
                                $invalid_id_reason_obj = DB::table('invalid_id_reasons')->where('id', $valid_id_user->invalid_reason_id)->first();
                            @endphp
                        @endif

                        </span>
                        <!-- {{ ($valid_id_user->is_valid == '1') ? '' : '$invalid_reason->slug' }} -->
                    </span>
                    <br>
                    @if ($valid_id_user->is_valid == '0')
                        <span class="text-muted">Invalid reason: {{$valid_id_user->invalid_reason->display_name}}</span>
                    @endif

                    <br>
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
