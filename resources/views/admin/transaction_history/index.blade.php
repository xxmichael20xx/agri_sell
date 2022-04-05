@extends('admin.front')
@section('content')
    
    <div class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Transaction history</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="toolbar">
                                <!--        Here you can write extra buttons/actions for the toolbar              -->
                            </div>
                            <table id="datatable" class="table " cellspacing="0" width="100%">
                                <thead class=" text-primary">
                                <tr><th>
                                        Name
                                    </th>
                                    <th>
                                        Transaction type
                                    </th>
                                    <th>
                                        Amount
                                    </th>
                                    <th>
                                        Transaction reference ID
                                    </th>
                                    <th>
                                        Date
                                    </th>
                                </tr></thead>
                                <tbody>
                                @foreach ($trans as $tran)
                                    <tr>
                                        <td>
                                            {{$tran->user_master->name ?? 'unavailable'}}
                                        </td>
                                        <td>
                                            {{$tran->trans_type}}
                                        </td>
                                        <td>
                                            {{$tran->amount}}
                                        </td>
                                        <td>
                                             {{$tran->trans_ref_id}}
                                        </td>
                                        <td>
                                            {{$tran->created_at}}
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
