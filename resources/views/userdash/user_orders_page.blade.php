@extends('userdash.user_dash_front')
@section('user_dash')
<div class="col-lg-9">
    <h1 class="lead display-6 mb-2">My Orders</h1>
    @include('userdash.users_orders_delivery_cat')
</div>
@endsection