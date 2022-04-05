@extends('riderPanel.front')
@section('content')
<div class="content">
    <div class="row">
    <div class="col-12">
            <div class="card">
                <div class="card-header">
                    @php
                        $suborder_item_ent = App\SubOrderItem::where('id', $suborder_item_id)->first();                        
                    @endphp
                <h5>Order products monitoring for {{$suborder_item_ent->product->name ?? ''}}</h5>
                <div style="float:right">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addnewProductMonitoringLogModal">
                        Add new product monitoring log
                    </button>
                    
                </div>
                </div>
                <div class="card-body">
                    
                    <table class="table" class="table" cellspacing="0" width="100%">
                        <thead  class=" text-primary">
                            <tr>
                            <th></th>
                                <th>Created by</th>
                                <th>Status</th>
                                <th>Status notes</th>
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
                        <td>{{$product_monitoring_ent->status}}</td>
                        <td>{{$product_monitoring_ent->sub_order_item->quantity ?? 'not available'}}</td>
                        <td>{{$product_monitoring_ent->sub_order_item->price ?? 'not available'}}</td>
                        <td>{{$product_monitoring_ent->sub_order_item->sub_order_parent->updated_at ?? 'not available'}}</td>
                        </tr>  
                    @endforeach                   
                    </tbody>
                    </table>
                    <!-- Modal -->
                <div class="modal fade " id="addnewProductMonitoringLogModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Monitoring log title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="addprodmonitor" action="/order_products_monitoring_upload" enctype="multipart/form-data" method="POST">
                            @csrf
                        </form>
                    <script>
                                function preview_images() 
                                {
                                var total_file=document.getElementById("images").files.length;
                                for(var i=0;i<total_file;i++)
                                {
                                $('#image_preview').append("<div class='col-md-3'><img class='img-responsive' src='"+URL.createObjectURL(event.target.files[i])+"'></div>");
                                }
                                }
                                </script>
                                <div class="col-md-12">
                                <label>Product images</label>
                                <input type="hidden" name="user_id"  form="addprodmonitor" value="{{Auth::user()->id}}"/>
                                <input type="file" class="form-control" id="images" form="addprodmonitor" name="images[]" onchange="preview_images();" multiple/>
                                </div>
                                <input type="hidden" form="addprodmonitor" name="product_sub_order_id" value="{{$suborder_item_id}}" />
                                <div class="row m-1" id="image_preview"></div>
                                <div class="col-md-12">
                                <div class="form-group">
                                <label>Product status notes</label>
                                <textarea class="form-control" form="addprodmonitor" name="prod_status_names" rows="3"></textarea>
                                </div>
                                </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" href=""  form="addprodmonitor"  class="btn btn-primary">Save changes</a>
                    </div>
                    </div>
                </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection