<div class="card">
    <div class="card-header">
        <h4 class="card-title">Seller registration fee {{$remark_name}}</h4>
    </div>
    @php
    $users = App\seller_reg_fee::where('status', $remark_id)->get();
    @endphp
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
                    <tr>
                        <td>
                            {{$user->owner->name ?? 'Deleted'}}
                        </td>
                        <td>
                            <img src="{{asset('storage/'.$user->payment_proof)}}" height="100" alt="">
                        </td>
                        <td>
                            {{$user->trans_id}}
                        </td>
                        <td>
                            {{$user->info->remarks ?? 'Not available'}}
                        </td>
                     
                        <td class="text-right">
                               @if(isset($user->owner->name))
                                <a href="/admin/sell_reg_more_info/{{$user->id}}"
                                    class="btn btn-sm btn-primary text-white m-1">More info</a>
                               @endif
                                      <a href="/admin/sell_reg_delete/{{$user->id}}"
                                class="btn btn-sm btn-danger text-white m-1">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>