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
                    @if (($hours < 1 && $minutes < 59) || $user->is_seen == 'no')
                    <tr style="background-color: #EEEEEE;">
                    @else
                    <tr>
                    @endif
                        <td>
                            @if (($hours < 1 && $minutes < 59) || $user->is_seen == 'no')
                                <b> {{$user->shop->name ?? ''}}
                            {{$user->owner->name ?? ''}}</b>
                            New
                            @else
                            {{$user->shop->name ?? ''}}
                            {{$user->owner->name ?? ''}}
                            @endif                           
                        </td>
                        <td>
                            <a  href="{{env('APP_URL')}}/storage/{{$user->payment_proof}}">
                            <img src="{{asset('storage/'.$user->payment_proof)}}" height="100">
                            </a>
                        </td>
                        <td>
                        @if (($hours < 1 && $minutes < 59) || $user->is_seen == 'no')
                                <b> {{$user->trans_id?? ''}} </b>
                            New
                            @else
                            {{$user->trans_id ?? ''}}
                            @endif    
                        </td>
                        <td>
                            {{$user->info->remarks ?? ''}}
                        </td>
                        
                        <td class="text-right">
                               @if(isset($user->owner->name))
                                <a href="/admin/sell_reg_more_info/{{$user->id}}"
                                    class="btn btn-sm btn-primary text-white m-1">More info</a>
                                     <a  class="btn btn-sm btn-primary text-white m-1" href="/admin/sell_reg_approved/{{$user->id}}">
                                Approve
                               </a>
                                @include('admin.sell_reg_fees.set_invalid_reason')
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
@endsection
