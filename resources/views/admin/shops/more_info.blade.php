@extends('admin.front')
@section('content')
<div class="content">
<a href="/admin/manage_shops" class="btn btn-outline-dark btn-round m-1">Go back</a>
    <h4>Shop information for {{ $shop->name }}</h4>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="image">
                    <img src="{{ asset('storage/'.$shop->shop_bg) }}" alt="...">
                </div>
                <div class="card-body">
                    <div class="author">
                        <h5 class="title text-center">{{ $shop->name }}</h5>
                    </div>
                    <p class="description text-center">
                        {{ $shop->description }}
                    </p>
                </div>
                <div class="card-footer">
                    <hr>
                    <div class="button-container">
                        <div class="row">
                            <div class="col-lg-3 col-md-6 col-6 ml-center">
                                <h5 class="text-center dark-highlight">{{ $order_count }}<br><small>Total orders</small></h5>
                            </div>
                            <div hidden class="col-lg-4 col-md-6 col-6 ml-auto mr-auto">
                                <h5 class="text-center dark-highlight">{{ $shopAveRating }}<br><small>Average rating</small></h5>
                            </div>
                            <div hidden class="col-lg-3 mr-auto">
                                <h5 class="text-center dark-highlight">&#8369;{{ $total_sales }}<br><small>Total sales</small></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <a hidden href="/admin/edit_shop/{{ $shop->id }}" class="btn btn-warning btn-round m-1">Edit shop</a>
            <a hidden href="" class="btn btn-warning btn-round m-1">Confirm shop</a>
            <!-- @if($shop->is_active == 1)
                <a href="/admin/set_inactive_shop/{{ $shop->id }}" class="btn btn-danger btn-round m-1">Deactivate
                    shop</a>
            @else
                <a href="/admin/set_active_shop/{{ $shop->id }}" class="btn btn-success btn-round m-1">Activate
                    shop</a>
            @endif -->
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">Shop owner details</h5>
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-12 pr-1">
                            <div class="form-group">
                                <label class="dark-highlight">Owner name</label>
                                <text class="form-control border-0">{{ $shop->owner->name ?? 'not available'}} </text>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12 pr-1">
                            <div class="form-group">

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 pr-1">
                            <div class="form-group">
                                <label class="dark-highlight">Email</label>
                                <text class="form-control border-0">{{ $shop->owner->email ?? 'not available'}} </text>
                            </div>
                        </div>
                        <div class="col-md-6 pl-1">
                            <div class="form-group">
                                <label class="dark-highlight">Mobile</label>
                                <text class="form-control border-0">{{ $shop->owner->mobile ?? 'not available' }} </text>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="dark-highlight">Birth day</label>
                                <text class="form-control border-0">{{ $shop->owner->bday ?? 'not available'}} </text>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 pr-1">
                            <div class="form-group">
                                <label class="dark-highlight">Province</label>
                                <text class="form-control border-0">{{ $shop->owner->province ?? 'not available'}} </text>
                            </div>
                        </div>
                        <div class="col-md-4 px-1">
                            <div class="form-group">
                                <label class="dark-highlight">Town/City</label>
                                <text class="form-control border-0">{{ $shop->owner->town ?? 'not available'}} </text>
                            </div>
                        </div>
                        <div class="col-md-4 pl-1">
                            <div class="form-group">
                                <label class="dark-highlight">Barangay</label>
                                <text class="form-control border-0">{{ $shop->owner->barangay ?? 'not available' }} </text>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                @php
                    $payment_details_obj = App\seller_reg_fee::where('user_id', $shop->owner->id)->first();
                @endphp
                    <h5 class="title">Payment details</h5>
                    <div class="row">
                        <div class="col-md-8 pr-1">
                            @if (isset($payment_details_obj->payment_proof))
                                <img src="{{asset('storage/'.$payment_details_obj->payment_proof)}}" alt="Not available">
                            @endif
                        </div>
                    </div>
                </div>
         
                
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 pr-1">
                            <div class="form-group">
                                <label>Transaction code</label>
                                <text class="form-control border-0">{{ $payment_details_obj->trans_id ?? 'not available'  }} </text>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                    <div class="col-md-6 pr-1">
                            <div class="form-group">
                                <label>Date created at</label>
                                <text class="form-control border-0">{{ $payment_details_obj->created_at ?? 'not available'}} </text>
                            </div>
                        </div>
                    </div>
                  
                   
                  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
