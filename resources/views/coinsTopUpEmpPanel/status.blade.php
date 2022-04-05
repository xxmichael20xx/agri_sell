@extends('coinsTopUpEmpPanel.front')
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Employee coins top status</h4>
                        <div style=""></div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="toolbar">
                                <!--        Here you can write extra buttons/actions for the toolbar              -->
                            </div>
                            <table id="datatable" class="table " cellspacing="0" width="100%">
                                <thead class=" text-primary">
                                <tr>
                                 
                                    <th>
                                        Date
                                    </th>
                                    <th>
                                        Amount
                                    </th>
                             
                                    <th>
                                        Transaction ID/reference ID
                                    </th>
                                    <th>
                                        Status
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($coinsTopUps as $coinsTopUp)
                                    <tr>
                                    
                                    <td>
                                    {{$coinsTopUp->created_at}}
                                    </td>
                                    <td>
                                    {{ $coinsTopUp->coins_top_up->value ?? 'not available'}} 
                                    </td>
                                  
                                    <td>
                                    {{ $coinsTopUp->cust_trans_id ?? 'not available'}}
                                    </td>
                                    <td>
                                    {{ $coinsTopUp->status}}
                                    </td>
                                </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">User coins top up entry</h4>
                        <div style=""></div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="toolbar">
                                <!--        Here you can write extra buttons/actions for the toolbar              -->
                            </div>
                            <table id="datatable2" class="table " cellspacing="0" width="100%">
                                <thead class=" text-primary">
                                <tr>
                                    <th>
                                        Customer name
                                    </th>
                                    <th>
                                        Transaction code
                                    </th>
                                    <th>
                                        Amount
                                    </th>
                                    <th>
                                        Transaction type
                                    </th>
                                    <th>
                                        Status
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($userCoinsTopUps as $usercoinsTopUp)
                                    <tr>
                                    <td>
                                    {{$usercoinsTopUp->owner->name}}
                                    </td>
                                    <td>
                                    {{$usercoinsTopUp->trans_id}}
                                    </td>
                                    <td>
                                    {{$usercoinsTopUp->value}}
                                    </td>
                                    <td>
                                    {{$usercoinsTopUp->coins_trans_type}}
                                    </td>
                                    <td>
                                    {{($usercoinsTopUp->remarks == '1') ? 'accepted' : 'invalid'}}
                                    </td>
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
