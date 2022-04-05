@extends('layouts.app_enlink')

@section('content')
{{-- Need to specify route redirects condition because of the auth verify bug in controller--}}
@guest
    <script>window.location = "/";</script>
@else
@if (Auth::user()->is_accepted_user_tos == 'no')
    <script>window.location = "/user_tos";</script>
@endif
@if(!(Auth::user()->email_verified_at == NULL || Auth::user()->email_verified_at == ''))
    <script>window.location = "/";</script>
@endif
@endguest

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-lg ">
                <div class="card-header border-0 bg-success text-white p-3">{{ __('Verify Your Email Address') }}</div>
                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                        {{ __('Check it in your spam folder') }},

                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
