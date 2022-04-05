@extends('layouts.app_enlink')

@section('content')

<div class="container h-100">
    <div class="row align-items-center h-100">
        <div class="col-9 mx-auto">
            <div class="jumbotron bg-white text-center">
                <!-- refer to seller payment reg rem table-->
                @php
                    $seller_reg_fee_obj = App\seller_reg_fee::where('user_id', Auth::user()->id)->first();
                @endphp
                                
                @if($seller_reg_fee_obj->info->remarks == 'invalid')
                    <h1 class="display-6">Please pay your seller registration fee</h1>
                    <p class="text-secondary">If you believe that this is wrong send an email
                        to {{ env('MAIL_USERNAME') }}</p>
                    <a href="registration_fee_instructions" class="btn btn-success text-white">Show me how</a>
                    {{-- <a class="btn btn-primary">Okay</a> --}}
                    <a href="registration_fee_instructions" class="btn btn-success text-white">Re submit payment </a> 

                @endif
                @if($seller_reg_fee_obj->info->remarks == 'invalid')
                <h3 class=" lead">Invalid payment proof</h3>
                    <img src="cliparts/ladybug.png" height="300">
                    <br>

                    <a href="registration_fee_instructions" class="btn btn-success text-white">Re submit payment
                        proof</a>
                        
                @endif
                <!-- invalid -->
                @if($seller_reg_fee_obj->info->remarks == 'for verification')
                    <h3 class=" lead">Please wait for the admin to confirm your shop</h3>
                    <img src="cliparts/house.png" height="300">
                    <br>
                    <a href="/home" class="btn btn-success text-white w-50">Home</a>
                    <a href="registration_fee_instructions" class="btn btn-success text-white w-50 mt-2">Change payment </a> 
                @endif



            </div>
        </div>
    </div>
</div>


@endsection
