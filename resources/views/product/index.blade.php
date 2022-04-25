@extends('layouts.front')
@section('content')
<div class="container pt-5">
    <h2 class="mb-2"> {{ $categoryName ?? null }} Products </h2>

    <div class="custom-row-2 my-5">
        @forelse ($products as $product)
            @include('product._single_product')
        @empty
            <div class="col-12">
                <label class="col-form-label">No product(s)</label>
            </div>
        @endforelse
    </div>
</div>
@endsection
