@extends('admin.front')
@section('content')
@php
    $exports = [
        [
            'href' => "/export/csv/transactions/full",
            'label' => 'CSV'
        ],
        [
            'href' => "/export/pdf/transactions/full",
            'label' => 'PDF'
        ]
    ];
    $inc = [
        'type' => 'admin_transactions',
        'key' => 'admin_transactions' . rand( 50, 1000 ),
        'reports' => $exports,
        'csv_url' => '/export/csv/transactions/current',
        'pdf_url' => '/export/pdf/transactions/current',
    ];
@endphp
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4 class="card-title">Transaction history</h4>
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="report--activity-logs" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Report Generation
                        </button>
                        <div class="dropdown-menu">
                            @include( 'admin.export.modal_trigger', $inc )
                            @include( 'admin.export.months_trigger', $inc )
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable" class="table" cellspacing="0" width="100%">
                            <thead class="text-primary">
                                <tr>
                                    <th>
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
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($trans as $tran)
                                    @if ( $tran->user_master )
                                        <tr>
                                            <td>
                                                {{ $tran->user_master->name }}
                                            </td>
                                            <td>
                                                {{ $tran->trans_type }}
                                            </td>
                                            <td>
                                                @if ( $tran->amount == 'not applicable' || $tran->amount == '0' )
                                                    ₱ 0 ( no payment )
                                                @else
                                                    ₱ {{ AppHelpers::numeric( $tran->amount ) }}
                                                @endif
                                            </td>
                                            <td>
                                                {{ $tran->trans_ref_id }}
                                            </td>
                                            <td>
                                                {{ $tran->created_at }}
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include( 'admin.export.modal_content', $inc )
@include( 'admin.export.months_modal', $inc )
@endsection
