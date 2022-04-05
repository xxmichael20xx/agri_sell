@extends('admin.front')
@section('content')
<div class="content">
    <a href="/admin/manage_users" class="btn btn-outline-dark btn-round m-1">Go back</a>
    <div class="row mt-2">
        <div class="col-md-6">
            <div class="card card-user">
                <div class="image" style="height: 230px;">
                    <img src="{{ asset('storage/' . $user->avatar) }}" alt="...">
                </div>
                <div class="card-body">
                    <div class="">
                        <h5 class="title text-center text-primary">{{ $user->name }}</h5>

                        <p class="description text-center">
                            {{ $user->email }}
                        </p>
                    </div>
                    <p class="description text-center">
                        {{ $user->mobile }}
                    </p>
                    <p class="description text-center">
                        {{ $user->role->name }}
                    </p>
                </div>
                <div class="card-footer">
                    <hr>
                    <div class="button-container">


                        @if($user->role->name == 'user')
                            <div class="row">
                                <div class="col-lg-3 col-md-6 col-6 ml-auto">
                                    <h5>{{ $coins_total }}<br><small>Agri coins</small></h5>
                                </div>
                                <div class="col-lg-4 col-md-6 col-6 ml-auto mr-auto">
                                    <h5>{{ $order_qty }}<br><small>Orders</small></h5>
                                </div>
                                <div class="col-lg-3 mr-auto">
                                    <h5>{{ $ordered_products_qty }}<br><small>Ordered products qty</small></h5>
                                </div>
                            </div>


                        @endif


                    </div>
                </div>
            </div>

        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">Additional details</h5>
                </div>
                <div class="card-body">

                   
                    <div class="row">
                        <div class="col-md-6 pr-1">
                            <div class="form-group">
                                <label>Email</label>
                                <text class="form-control border-0"> {{$user->email}}</text>
                            </div>
                        </div>
                        <div class="col-md-6 pl-1">
                            <div class="form-group">
                                <label>Mobile</label>
                                <text class="form-control border-0"> {{$user->mobile}}</text>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Birth day</label>
                                <text class="form-control border-0"> {{$user->bday}}</text>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Address line/Purok</label>
                                <text class="form-control border-0"> {{$user->address}}</text>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 pr-1">
                            <div class="form-group">
                                <label>Barangay</label>
                                <text class="form-control border-0"> {{$user->barangay}}</text>
                            </div>
                        </div>
                       
                        <div class="col-md-4 pl-1">
                            <div class="form-group">
                                <label>Town/City</label>
                                <text class="form-control border-0"> {{$user->town}}</text>
                            </div>
                        </div>
                        <div class="col-md-4 px-1">
                            <div class="form-group">
                                <label>Province</label>
                                <text class="form-control border-0"> {{$user->province}}</text>
                            </div>
                        </div>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
   
</div>
@endsection
