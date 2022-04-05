@extends('layouts.front')


@section('content')

<div class="container pt-5">
    <h2 class="mb-2"> {{ $categoryName ?? null }} Products </h2>

    <div class="custom-row-2 mt-5">
    @foreach ($products as $product)
        @include('product._single_product')
    @endforeach

    </div>
</div>

@endsection
