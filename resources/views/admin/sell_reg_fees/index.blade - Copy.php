@extends('admin.front')
@section('content')
<div class="content">
    

<div class="card">
    <div class="card-header">
        <h4 class="card-title">Seller registration fee</h4>
    </div>
  
    <div class="card-body">
        <div class="table-responsive">
            <div class="toolbar">
                <!--        Here you can write extra buttons/actions for the toolbar -->
            </div>
            <table id="datatable" class="table" cellspacing="0" width="100%">
                <thead class=" text-primary">
                    <tr>
                        <th>
                            Name
                        </th>
                        <th>
                            Image proof
                        </th>
                        <th>
                            Transaction code
                        </th>
                        <th>
                            Remarks
                        </th>
                        <th class="text-right">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    @php
                            $delta_time = time() - strtotime($user->created_at);
                            $hours = floor($delta_time / 3600);
                            $delta_time %= 3600;
                            $minutes = floor($delta_time / 60);
                            // updated is seened each
                    @endphp
                    @if ($minutes < 15 || $user->is_seen == 'no')
                    <tr style="background-color: #EEEEEE;">
                    @else
                    <tr>
                    @endif
                        <td>
                        
                            @if ($minutes < 15 || $user->is_seen == 'no')
                                <b> {{$user->shop->name ?? 'deleted'}}
                            {{$user->owner->name ?? 'Deleted'}}</b>
                            New
                            @else
                            {{$user->shop->name ?? 'deleted'}}
                            {{$user->owner->name ?? 'Deleted'}}
                            @endif
                            
                           
                        </td>
                        <td>
                            <img src="{{asset('storage/'.$user->payment_proof)}}"   data-toggle="modal" 
             data-target="#exampleModal{{$user->id}}" height="100" alt="">

               <div class="modal fade" 
             id="exampleModal{{$user->id}}"
             tabindex="-1" 
             role="dialog"
             aria-labelledby="exampleModalLabel" 
             aria-hidden="true">
            <div class="modal-dialog" 
                 role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <!-- w-100 class so that header
                div covers 100% width of parent div -->
                        <h5 class="modal-title w-100" 
                            id="exampleModalLabel">
                     
                      </h5>
                        <button type="button"
                                class="close"
                                data-dismiss="modal" 
                                aria-label="Close">
                            <span aria-hidden="true">
                              ×
                          </span>
                        </button>
                    </div>
  
                    <!--Modal body with image-->
                    <div class="modal-body">
                        <img  src="{{asset('storage/'.$user->payment_proof)}}"  />
                    </div>
  
                    <div class="modal-footer">
                        <button type="button"
                                class="btn btn-danger" 
                                data-dismiss="modal">
                          Close
                      </button>
                    </div>
                </div>
            </div>
        </div>
                        </td>
                        <td>
                        @if ($minutes < 15)
                            <b>{{$user->trans_id}}</b>
                        @endif
                        </td>
                        <td>
                            {{$user->info->remarks ?? 'Not available'}}
                        </td>
                        
                        <td class="text-right">
                               @if(isset($user->owner->name))
                                <a href="/admin/sell_reg_more_info/{{$user->id}}"
                                    class="btn btn-sm btn-primary text-white m-1">More info</a>
                                     <a  class="btn btn-sm btn-primary text-white m-1" href="/admin/sell_reg_set/{{$user->id}}">
                               Set as valid 
                               </a>
                                @else
                                 <a href="/admin/sell_reg_delete/{{$user->id}}"
                                class="btn btn-sm btn-danger text-white m-1">Delete</a>
                                <span class="btn btn-sm" style="background-color: #E45826">Deleted user</span>
                               @endif
                              
                        </td>
                    </tr>
                    @php
                    DB::table('seller_registration_fee')->where('id', $user->id)->update(['is_seen' => 'yes']);
                    @endphp
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Old revision of sell reg fees with filtration --}}
<div class="content" hidden>
        <div class="row">
          <div class="col-md-12">
             <div class="nav-tabs-navigation">
                <div class="nav-tabs-wrapper">
                    <ul id="tabs" class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#paid" role="tab"
                                aria-expanded="true">Paid</a>
                        </li>
                        <li hidden class="nav-item">
                            <a class="nav-link" hidden data-toggle="tab" href="#unpaid" role="tab"
                                aria-expanded="false">Unpaid</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#invalid" role="tab"
                                aria-expanded="false">Invalid</a>
                        </li>   
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#uploaded" role="tab"
                                aria-expanded="false">For verification</a>
                        </li>                  
                    </ul>
                </div>
            </div>
            <div id="my-tab-content" class="tab-content">
                <div class="tab-pane active" id="paid" role="tabpanel" aria-expanded="true">
                    <div class="col-md-12">
                        @php
                        $remark_id = '1';
                        $remark_name = 'Paid';
                        @endphp
                        @include('admin.sell_reg_fees.index_subcat')
                    </div>
                </div>
                <div class="tab-pane" hidden id="unpaid" role="tabpanel" aria-expanded="false">
                <div class="col-md-12">
                        @php
                        $remark_id = '2';
                        $remark_name = 'Unpaid';
                        @endphp
                        @include('admin.sell_reg_fees.index_subcat') 
                    </div>
                </div>
                <div class="tab-pane" id="invalid" role="tabpanel" aria-expanded="false">
                  <div class="col-md-12">
                        @php
                        $remark_id = '3';
                        $remark_name = 'Invalid';
                        @endphp
                        @include('admin.sell_reg_fees.index_subcat') 
                    </div>
                </div>
                <div class="tab-pane" id="uploaded" role="tabpanel" aria-expanded="false">
                  <div class="col-md-12">
                        @php
                        $remark_id = '4';
                        $remark_name = 'For verification';
                        @endphp
                        @include('admin.sell_reg_fees.index_subcat') 
                    </div>
                </div>
            </div>  
            </div>
          </div>
      </div>
      </div>
@endsection
