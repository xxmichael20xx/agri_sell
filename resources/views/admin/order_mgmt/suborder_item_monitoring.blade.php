@extends('admin.front')
@section('content')
<div class="content">
    <div class="row">
    <div class="col-12">
            <div class="card">
                <div class="card-header">
                <h5>Order products monitoring</h5>
                </div>
                <div class="card-body">
                    <table class="table" class="table" cellspacing="0" width="100%">
                        <thead  class=" text-primary">
                            <tr>
                            <th></th>
                            <th>Created by</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Date reflected</th>
                            </tr>
                        </thead>
                        <tbody>
                
                    @foreach($product_monitoring_logs as $product_monitoring_ent)
                    <tr>
                        <td>
                            <div class="row">
                                    @php
                                    $product_monitoring_ent_images = $product_monitoring_ent->images;
                                    $images = $product_monitoring_ent_images ?? 'not available';
                                    $pieces = explode(",", $images);         
                                    @endphp                
                                    @foreach ($pieces as $piece)
                                        <div style="width: 135px; height: 135px;display: inline-block; margin: 5px;background-position: center;background-size: cover;background-image: url('{{env('APP_URL')}}/storage/{{$piece}}');" ></div>
                                    @endforeach
                                </div>
                        </td>
                        <td>{{$product_monitoring_ent->created_by_user->name ?? 'not available'}}</td>

                        <td>{{$product_monitoring_ent->sub_order_item->product->name ?? 'not available'}}</td>
                        <td>{{$product_monitoring_ent->sub_order_item->sub_order_parent->deliverystatus->display_name ?? 'not available'}}</td>
                        <td>{{$product_monitoring_ent->sub_order_item->quantity ?? 'not available'}}</td>
                        <td>{{$product_monitoring_ent->sub_order_item->price ?? 'not available'}}</td>
                        <td>{{$product_monitoring_ent->sub_order_item->sub_order_parent->updated_at ?? 'not available'}}</td>
                        </tr>  
                    @endforeach                   
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection