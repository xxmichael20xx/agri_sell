@extends('coinsTopUpEmpPanel.front')
@section('content')

    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Refunded coins top up</h4>
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
                                        Employee code
                                    </th>
                                    <th>
                                        Customer name
                                    </th>
                                    <th>
                                        Amount requested
                                    </th>
                                    <th>
                                        Transaction/Reference ID
                                    </th>
                                    <th>
                                        Sender gcash/paymaya/palawan phone number
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
                                    {{$coinsTopUp->employee->id ?? 'not available'}}
                                    </td>
                                    <td>
                                    {{$coinsTopUp->customer->name ?? 'not available'}}
                                    </td>
                                    <td>
                                    {{ $coinsTopUp->coins_top_up->value ?? 'not available'}} 
                                    </td>
                                    <td>
                                    {{ $coinsTopUp->cust_trans_id ?? 'not available'}}
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
        </div>
@endsection
