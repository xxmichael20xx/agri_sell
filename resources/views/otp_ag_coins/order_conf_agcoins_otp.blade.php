@extends('layouts.front')
@section('content')
<div class="row justify-content-center" style="height: 1000px;">
    <div class="col col-8">
        <div class="text-center">
            <h3 class="mt-5">Please enter your OTP to confirm Agricoins </h3>
            <h5 class="lead">To confirm the use of your Agri coins check your email {{Auth::user()->email}} </h5>
            <p>Check your spam folder if the OTP email does not show </p>
            <p>Enter your OTP code below</p>
            <div class="form-group">
                <form action="/otp_validation_confirmation" method="POST">
                    @method('POST')
                    @csrf
                    <input hidden type="text" name="order_num" value="{{$order_num}}">
                    <input type="text" name="inputted_otp" maxlength="6" style="width: 200px;" class="form-control-lg">
                    <br>
                    <button type="submit" name="btn_submit" class="mt-2 btn btn-primary btn-lg">Submit</button>
                </form>
        </div>
</div>
</div>
</div>
@endsection