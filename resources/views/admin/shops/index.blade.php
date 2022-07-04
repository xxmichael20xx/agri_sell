@extends('admin.front')
@section('content')
@php
    $inc = [
        'csv_url' => '/export/csv/shops/current/default',
        'pdf_url' => '/export/pdf/shops/current/default',
        'key' => rand( 50, 1000 )
    ];
@endphp
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
                            @php
                                $reportInc = [
                                    'type' => 'admin_shops',
                                    'key' => 'admin_shops_' . rand( 50, 1000 )
                                ];
                            @endphp
                            @include( 'admin.export.modal_trigger', $reportInc )
                            @include( 'admin.export.months_trigger', $inc )
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

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title font-weight-bold">Top-Bottom Shops</h5>
                </div>
                <div class="card-body">
                    @include('admin.charts.top_bottom_shops')
                </div>
            </div>
        </div>
    </div>
</div>
@include( 'admin.export.modal_content', $reportInc )
@include( 'admin.export.months_modal', $inc )
@endsection