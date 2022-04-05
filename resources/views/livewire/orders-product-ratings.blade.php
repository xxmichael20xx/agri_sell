<div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
.checked {
    color: orange;
}
</style>
@if (floatval($product_rate->userAverageRating) == null)
    <span>Unrated</span>
@endif
@if (floatval($product_rate->userAverageRating) != null)
<span>Your rating: </span>
@endif

<a> <span class="fa fa-star {{(floatval($product_rate->userAverageRating) >= 1) ? 'checked' : '' }}" wire:click="addRating('1', '{{$prid}}')"></span></a>
<a> <span class="fa fa-star {{(floatval($product_rate->userAverageRating) >= 2) ? 'checked' : '' }}" wire:click="addRating('2', '{{$prid}}')"></span></a>
<a> <span class="fa fa-star {{(floatval($product_rate->userAverageRating) >= 3) ? 'checked' : '' }}" wire:click="addRating('3', '{{$prid}}')"></span></a>
<a> <span class="fa fa-star {{(floatval($product_rate->userAverageRating) >= 4) ? 'checked' : '' }}" wire:click="addRating('4', '{{$prid}}')"></span></a>
<a> <span class="fa fa-star {{(floatval($product_rate->userAverageRating) >= 5) ? 'checked' : '' }}" wire:click="addRating('5', '{{$prid}}')"></span></a>

</div>
