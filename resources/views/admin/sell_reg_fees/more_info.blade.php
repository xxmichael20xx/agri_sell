@extends('admin.front')
@section('content')
    <div class="content">
        <a href="/admin/sell_reg_fees" class="btn btn-outline-dark btn-round m-1">Go back</a>
        <div class="row">
            <div class="col-md-8">
                <div class="card card-plain">
                    <div class="card-header">
                        <h5 class="card-title">Seller registration fee</h5>
                    </div>
                    <div class="card-body">
                        <a href="{{env('APP_URL')}}/storage/{{$user->payment_proof}}">
                           <img src="{{asset('storage/'.$user->payment_proof)}}" alt="" height="300">
                        </a>    
                       <br>
                        <div class="mt-5"></div>
                        @php
                            // $user_obj = DB::table('users')->where('id', $user->user_id)->first();
                            $user_obj = App\User::where('id', $user->user_id)->first();
                        @endphp
                        <br>
                        <h4>Shop details</h4>
                        <span class="text-muted">Shop name: {{$user_obj->shop->name ?? ''}}</span>
                        <br>
                        <span class="text-muted">Shop description: {{$user_obj->shop->description ?? ''}}</span>
                        <br>
                        <h4>Payment details</h4>
                        <span class="text-muted">Name: {{$user_obj->name ?? ''}}</span>
                        <br>
                        <span class="text-muted">Address: {{$user_obj->address ?? ''}} {{$user_obj->barangay  ?? ''}} {{$user_obj->town  ?? ''}} {{$user_obj->province  ?? ''}}</span>
                        <br>
                        <span class="text-muted">Transaction code:  {{$user->trans_id}}</span>
                        <br>
                        <a class="btn btn-sm btn-primary text-white m-1" href="/admin/sell_reg_approved/{{$user->id}}" >
                            Set as valid 
                        </a>
                        <br>
                       @include('admin.sell_reg_fees.set_invalid_reason')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
