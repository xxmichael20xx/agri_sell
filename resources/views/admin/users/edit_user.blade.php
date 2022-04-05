@extends('admin.front')
@section('content')
<div class="content">
    <a href="/admin/manage_users" class="btn btn-outline-dark btn-round m-1">Go back</a>

    <div class="row">

        <div class="col-md-8 mt-3">
            <div class="card">
                <div class="card-header">
                    <h5>Edit basic information details</h5>
                </div>
                <div class="card-body">
                    <form action="/user_edit_submit" method="POST">
                        @csrf
                        <div class="row">

                            <div class="col-md-6 ">
                                <div class="form-group">
                                    <label>Full name</label>
                                    <input type="mobile" class="form-control" name="full_name"
                                        value="{{ $user->name }}">
                                </div>
                            </div>

                            <div class="col-md-6 ">
                                <div class="form-group">
                                    <label>Mobile</label>
                                    <input type="mobile" class="form-control" name="mobile"
                                        value="{{ $user->mobile }}">
                                </div>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-md-12 ">
                                <div class="form-group">
                                    <label>Password(leave blank if not applicable)</label>
                                    <input type="password" class="form-control" name="password">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 ">
                                <div class="form-group">
                                    <div class="form-group">
                                    <label>User role</label>
                                        <select class="form-control" name="role_id">
                                        @foreach ($roles as $role)
                                            <option value="{{$role->id}}">{{$role->name}}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Birthday</label>
                                    <input type="date" class="form-control" name="bday" value="{{ $user->bday }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                <h5>Address details</h5>
                                <span class="muted">Leave black if you will not edit</span>
                                <br>
                                    <label>Address line/Purok</label>
                                    <input type="text" class="form-control" name="address_line"
                                        value="{{ $user->address }}">
                                </div>
                            </div>
                        </div>                        
                        <input type="hidden" name="user_id" value="{{$user->id}}">
                        <input type="hidden" disabled id="brgyval" name="barangay">
                        <input type="hidden" disabled id="townval" name="town">
                        <input type="hidden" disabled id="provval" name="province">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    @include('admin.users.edit_user_address_dropdown')
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <input type="submit" class="btn btn-primary btn-round m-1">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
