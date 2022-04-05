@extends('layouts.front')
@section('content')
<div class="container" style="height: 1260px;">
    <div class="row">
        <div class="col-12">
            <form  method="POST" id="addProduct" enctype="multipart/form-data" action="{{ route('refund_request')}}">
                @csrf
                @method('POST')
            <h2 class="mt-5">Refund {{$order_item_ent->product->name ?? 'not available'}} for order {{$order_ent->order_number ?? 'not available'}}</h2>
            <p>1. Upload picture of evidences to process your refund in products</p>
          
            <input type="hidden" name="order_id" value="{{$order_ent->id}}">
            <input type="hidden" name="product_id" value="{{$order_item_ent->product->id ?? 'none'}}">
            <input type="hidden" name="order_item_id" value="{{$order_item_ent->id ?? ''}}">
            <input type="file" class="form-control mb-2" id="images" form="addProduct" name="images[]"
                onchange="preview_images();" multiple />
                <p>2. Messages for refunding the product</p>
            <div class="row">
                <div class="col-8">
                <textarea name="reason_prod_txt"></textarea>
                </div>
            </div>
       
            <p>3. Wait for the admin to process the refund</p>
                <input type="submit" class="btn btn-success col-2" value="Submit">
            </form>
              <script>
                function preview_images() {
                    var total_file = document.getElementById("images").files.length;
                    for (var i = 0; i < total_file; i++) {
                        $('#image_preview').append("<div class='col-md-3'><img class='img-responsive' src='" + URL
                            .createObjectURL(event.target.files[i]) + "'></div>");
                    }
                }
            </script>
        </div>
    </div>
</div>
</div>
@endsection