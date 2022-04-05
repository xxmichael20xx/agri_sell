@extends('coinsTopUpEmpPanel.front')
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title"><h4>User coins top up management table</h4></div>
                        <div style="float:right;"><a class="btn btn-primary"href="/coins_entry">Encode new</a></div>
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
                                        Employee code
                                    </th>
                                    <th>
                                        Transaction/Reference ID
                                    </th>
                                    <th>
                                        Amount
                                    </th>
                                    <th>
                                        Top up type
                                    </th>
                                    <th>
                                        Created at
                                    </th>
                                    <th>
                                        Actions
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($coinsTopUps as $coinsTopUp)
                                    <tr>
                                    <td>
                                    {{$coinsTopUp->employee->name ?? 'not available'}}
                                    </td>
                                    <td>
                                    {{ $coinsTopUp->cust_trans_id ?? 'not available'}}
                                    </td>
                                    <td>
                                    {{ $coinsTopUp->value ?? 'not available'}}
                                    </td>
                                    <td>
                                    {{ $coinsTopUp->coins_trans_type ?? 'not available'}}
                                    </td>
                                    <td>
                                    {{ $coinsTopUp->created_at ?? 'not available'}}                                    
                                    </td>
                                    <td>
                                    <a href="/delete_coins_encode/{{$coinsTopUp->id}}" class="btn btn-danger btn-round btn-sm">Delete</a>
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
