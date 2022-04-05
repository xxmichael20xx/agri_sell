@extends('admin.front')
@section('content')
<div class="content">
  <div class="row">
    <div class="col-md-12">
      <h4>Refund request for {{$refund_request->product->name}}</h4>
    </div>
    <div class="col-md-12">
     @php
     $images = $refund_request->image_proofs ?? 'not available';
     $pieces = explode(",", $images);
     @endphp
     <p>Image proofs</p>

     @foreach ($pieces as $piece)
         <div style="width: 250px;height: 250px;background-position: center;display: inline-block;background-size: cover;background-image: url('{{env('APP_URL')}}/storage/{{$piece}}');"></div>
     @endforeach
     <br>
     <div class="card">
       <div class="card-header">Refund request description for {{$refund_request->refund_ref_id}}</div>
       <div class="card-body">
        {{$refund_request->refund_reason_prod_txt}}
    </div>
</div>

     <div class="card">
       <div class="card-header">Refund details for {{$refund_request->refund_ref_id}}</div>
       <div class="card-body">
       Shop name : {{$refund_request->product->shop->name ?? 'not available'}}<br>
       Product name : {{$refund_request->product->name ?? 'not available'}}<br>
        Quantity : {{$refund_request->order_item->quantity ?? 'not available'}}<br>
        Variation: {{$refund_request->order_item->product_variation->variation_name  ?? 'not available'}}<br>
        Refundable amount : 
        @php
          if(isset($refund_request->order_item->price)){
              $price_refundable =  $refund_request->order_item->price * $refund_request->order_item->quantity;
              echo $price_refundable;
          }else{
             echo 'not available';
          }
        @endphp
      

        Time & date:  {{$refund_request->created_at}}<br>
    </div>
     </div>
     <div class="card">
       <div class="card-header">Customer and shop owner details</div>
       <div class="card-body">
        Customer name: {{$refund_request->customer->name ?? 'not available'}}<br>
       Customer address: {{$refund_request->customer->address ?? 'not available'}} {{$refund_request->customer->barangay ?? 'not available'}} {{$refund_request->customer->town ?? 'not available'}}<br>
       Customer contact number:  {{$refund_request->customer->mobile ?? 'not available'}}<br>
       Shop contact number:  {{$refund_request->shop->owner->mobile ?? 'not available'}}
       <br>
       Shop owner name:  {{$refund_request->product->shop->owner->name ?? 'not available'}} <br>
       Shop address: {{$refund_request->product->shop->owner->address ?? 'not available'}} {{$refund_request->product->shop->owner->barangay ?? 'not available'}} {{$refund_request->product->shop->owner->town}}<br>
       Shop contact number:  {{$refund_request->shop->owner->mobile ?? 'not available'}}
</div>
     </div>
     <div class="card">
   <div class="col-md-12" style="padding-bottom: 100px;">

         @php
           $product_refund_statuses = DB::table('prod_refund_statuses')->get();
        @endphp
        <form method="POST" action="/admin_set_product_refund_status">
          @csrf
          @method('POST')
          <div class="card-header">Set refund status </div>
              <input type="hidden" name="refund_id" value="{{$refund_request->id}}">
               <select class="selectpicker w-100" data-style="btn btn-primary btn-round" title="Select product category" name="reason_id" role="dropdown" required>
                 @foreach ($product_refund_statuses as $product_refund_status)
                    <option value="{{$product_refund_status->id}}">{{$product_refund_status->slug}}</option>
                 @endforeach
              </select>
              <input class="btn btn-primary" type="submit" value="Save">
              </form>
           </div>  
  </div>
        
   </div>
  
 </div>
</div>
@endsection