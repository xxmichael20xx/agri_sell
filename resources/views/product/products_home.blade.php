@extends('layouts.front')


@section('content')

<div class="container">

    <div class="custom-row-2">
    @foreach ($products as $product)

        @include('product._single_product')
    @endforeach

    </div>


</div>

@endsection
@extends('layouts.front')


@section('content')

<div class="container">

    <div class="custom-row-2">
    @foreach ($products as $product)

        @include('product._single_product')
    @endforeach

    </div>


</div>

@endsection
