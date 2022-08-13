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
                                    <h5 class="dark-highlight">{{ $coins_total }}<br><small>Agri coins</small></h5>
                                </div>
                                <div class="col-lg-4 col-md-6 col-6 ml-auto mr-auto">
                                    <h5 class="dark-highlight">{{ $order_qty }}<br><small>Orders</small></h5>
                                </div>
                                <div class="col-lg-3 mr-auto">
                                    <h5 class="dark-highlight">{{ $ordered_products_qty }}<br><small>Ordered products qty</small></h5>
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
                                <label class="dark-highlight">Email</label>
                                <text class="form-control border-0"> {{$user->email}}</text>
                            </div>
                        </div>
                        <div class="col-md-6 pl-1">
                            <div class="form-group">
                                <label class="dark-highlight">Mobile</label>
                                <text class="form-control border-0"> {{$user->mobile}}</text>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="dark-highlight">Birth day</label>
                                <text class="form-control border-0"> {{$user->bday}}</text>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="dark-highlight">Address line/Purok</label>
                                <text class="form-control border-0"> {{$user->address}}</text>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 pr-1">
                            <div class="form-group">
                                <label class="dark-highlight">Barangay</label>
                                <text class="form-control border-0"> {{$user->barangay}}</text>
                            </div>
                        </div>
                       
                        <div class="col-md-4 pl-1">
                            <div class="form-group">
                                <label class="dark-highlight">Town/City</label>
                                <text class="form-control border-0"> {{$user->town}}</text>
                            </div>
                        </div>
                        <div class="col-md-4 px-1">
                            <div class="form-group">
                                <label class="dark-highlight">Province</label>
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
