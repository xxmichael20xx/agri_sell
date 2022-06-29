@extends('admin.front')
@section('content')
@php
    $months = array(
        'January',
        'February',
        'March',
        'April',
        'May',
        'June',
        'July ',
        'August',
        'September',
        'October',
        'November',
        'December',
    );
@endphp
<style>
    .dropdown--scroll {
        height: 250px;
        overflow-y: auto;
    }
</style>
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4 class="card-title">Manage shops</h4>
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="report--activity-logs" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Report Generation
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="/export/csv/shops/full/default" target="_blank">CSV - Full Approved</a>
                            <a class="dropdown-item clickable" data-href="/export/csv/shops/current/default" data-toggle="modal" data-target="#csvMonths">CSV/PDF - Months Report</a>
                            <a class="dropdown-item" href="/export/csv/shops/full/top" target="_blank">CSV - Top Performing</a>
                            <div class="dropdown-divider m-y-2"></div>
                            <a class="dropdown-item" href="/export/pdf/shops/full/default" target="_blank">PDF - Full Approved</a>
                            <a class="dropdown-item" href="/export/pdf/shops/full/top" target="_blank">PDF - Top Performing</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable" class="table " cellspacing="0" width="100%">
                            <thead class=" text-primary">
                                <tr>
                                    <th>
                                        Shop name
                                    </th>
                                    <th>
                                        Shop owner
                                    </th>
                                    <th>
                                        Shop approved date
                                    </th>
                                    <th>
                                        Shop description
                                    </th>


                                    <th class="text-right">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($shops as $shop)
                                    <tr>
                                        <td>
                                            {{ $shop->name ?? 'Not available' }}
                                        </td>
                                        <td>
                                            {{ $shop->owner->name ?? 'Not available' }}
                                        </td>
                                        <td>
                                            {{ $shop->date_approved }}
                                        </td>
                                        <td>
                                            {{ $shop->description ?? 'Not available' }}
                                        </td>
                                        <td class="text-right">
                                            <a href="/admin/manage_shop/{{ $shop->id }}" class="btn btn-sm btn-primary text-white m-1">More info</a>
                                            <a hidden href="/admin/edit_shop/{{ $shop->id }}" class="btn btn-sm btn-warning text-white m-1">Edit</a>
                                            <button type="button" data-text="Shop will be deleted!" data-href="/admin/delete_shop/{{ $shop->id }}" class="btn btn-sm btn-danger text-white m-1 btn--delete-confirm">Delete</button>
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
</div>

<div class="modal fade" id="csvMonths">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Months Report</h5>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="form-group row">
                        <div class="col-12">
                            <label for="select-type" class="col-form-label">Report Type</label>
                            <select name="select-type" id="select-type" class="custom-select">
                                <option value="" selected disabled>Select an option</option>
                                <option value="csv">CSV</option>
                                <option value="pdf">PDF</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row collapse" id="report-csv">
                        <div class="col-12">
                            <div class="dropdown">
                                <button class="btn btn-default dropdown-toggle w-100" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Select Month
                                </button>
                                <div class="dropdown-menu w-100 dropdown--scroll">
                                    @foreach ( $months as $month_index => $month )
                                        <a class="dropdown-item" href="/export/csv/shops/current/default/{{ $month_index + 1 }}" target="_blank">{{ $month }}</a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row collapse" id="report-pdf">
                        <div class="col-12">
                            <div class="dropdown">
                                <button class="btn btn-default dropdown-toggle w-100" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Select Month
                                </button>
                                <div class="dropdown-menu w-100 dropdown--scroll">
                                    @foreach ( $months as $month_index => $month )
                                        <a class="dropdown-item" href="/export/pdf/shops/current/default/{{ $month_index + 1 }}" target="_blank">{{ $month }}</a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('admin.custom_scripts')
    <script>
        (function($) {
            window.onload = () => {

                $( document ).on( 'change', '#select-type', function() {
                    const val = $( this ).val()

                    if ( val == 'csv' ) {
                        $( '#report-csv' ).removeClass( 'collapse' )
                        $( '#report-pdf' ).addClass( 'collapse' )

                    } else {
                        $( '#report-csv' ).addClass( 'collapse' )
                        $( '#report-pdf' ).removeClass( 'collapse' )
                    }
                } )

            }
        })(jQuery)
    </script>
@endsection