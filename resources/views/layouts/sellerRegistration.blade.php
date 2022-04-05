@extends('layouts.app_enlink')
@section('content')
    @if(Auth::user()->role_id == '4')
        <script>window.location = "/home";</script>
    @endif
    <script>
        function hide_tos() {
            document.getElementById("container_seller_reg").style.visibility = "visible";
            document.getElementById("toscontainer").style.display = "none";
        }

    </script>
    <div class="container" id="toscontainer">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card border-0 shadow-lg">

                    <div class="card-body">

                        @include('layouts.ToS');
                        <button onclick="hide_tos()" class="btn btn-primary w-100">I accept the TOS</button>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="container" id="container_seller_reg" style="visibility: hidden;transition-timing-function: ease-out;">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-0 shadow-lg">
                    <div class="card-header border-0 text-white bg-success pt-4 pb-4">
                        {{ __('Seller registration') }}</div>

                    <div class="card-body">
                        <form method="POST" action="sellRegsubmit" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="shopName"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Shop name') }}</label>

                                <div class="col-md-6">
                                    <input id="shopName" type="text"
                                           class="form-control @error('shopName') is-invalid @enderror" name="shopName"
                                           value="{{ old('shopName') }}" required autocomplete="name"
                                           autofocus>

                                    @error('shopName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="shopDesc"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Shop description') }}</label>

                                <div class="col-md-6">
                                <textarea id="shopDesc" type="text"
                                          class="form-control @error('shopDesc') is-invalid @enderror" name="shopDesc"
                                          value="{{ old('shopDesc') }}" required autocomplete="name"
                                          autofocus></textarea>
                                    @error('shopDesc')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-success">
                                        {{ __('Confirm') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
