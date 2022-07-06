@if ( $type == "admin_shops" )
    <div class="modal fade" id="{{ $key }}-full-approved">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Report: Full Approved</h5>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="form-group row">
                            <div class="col-12">
                                <div class="dropdown">
                                    <button class="btn btn-default dropdown-toggle w-100" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Report Type
                                    </button>
                                    <div class="dropdown-menu w-100">
                                        <a class="dropdown-item" href="/export/csv/shops/full/default" target="_blank">CSV</a>
                                        <a class="dropdown-item" href="/export/pdf/shops/full/default" target="_blank">PDF</a>
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

    <div class="modal fade" id="{{ $key }}-top-performing">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Report: Top Performing</h5>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="form-group row">
                            <div class="col-12">
                                <div class="dropdown">
                                    <button class="btn btn-default dropdown-toggle w-100" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Report Type
                                    </button>
                                    <div class="dropdown-menu w-100">
                                        <a class="dropdown-item" href="/export/csv/shops/full/top" target="_blank">CSV</a>
                                        <a class="dropdown-item" href="/export/pdf/shops/full/top" target="_blank">PDF</a>
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
@endif

@if ( $type == "admin_users" )
    <div class="modal fade" id="{{ $key }}">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Report: Full List</h5>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="form-group row">
                            <div class="col-12">
                                <div class="dropdown">
                                    <button class="btn btn-default dropdown-toggle w-100" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Report Type
                                    </button>
                                    <div class="dropdown-menu w-100">
                                        <a class="dropdown-item" href="/export/csv/users/full/{{ $role_id }}" target="_blank">CSV</a>
                                        <a class="dropdown-item" href="/export/pdf/users/full/{{ $role_id }}" target="_blank">PDF</a>
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
@endif

@if ( $type == "admin_refunds" || $type == "admin_payout" )
    <div class="modal fade" id="{{ $key }}">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Report: Full Report</h5>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="form-group row">
                            <div class="col-12">
                                <div class="dropdown">
                                    <button class="btn btn-default dropdown-toggle w-100" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Report Type
                                    </button>
                                    <div class="dropdown-menu w-100">
                                        @foreach( $reports as $report )
                                            <a class="dropdown-item" href="{{ $report['href'] }}" target="_blank">{{ $report['label'] }}</a>
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
@endif

@if ( $type == "admin_orders" )
    <div class="modal fade" id="{{ $key }}">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Report: Full Orders</h5>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="form-group row">
                            <div class="col-12">
                                <div class="dropdown">
                                    <button class="btn btn-default dropdown-toggle w-100" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Report Type
                                    </button>
                                    <div class="dropdown-menu w-100">
                                        @foreach( $reports as $report )
                                            <a class="dropdown-item" href="{{ $report['href'] }}" target="_blank">{{ $report['label'] }}</a>
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
@endif

@if ( $type == "admin_transactions" || $type == "seller_payout" )
    <div class="modal fade" id="{{ $key }}">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Report: Full List</h5>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="form-group row">
                            <div class="col-12">
                                <div class="dropdown">
                                    <button class="btn btn-default dropdown-toggle w-100" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Report Type
                                    </button>
                                    <div class="dropdown-menu w-100">
                                        @foreach( $reports as $report )
                                            <a class="dropdown-item" href="{{ $report['href'] }}" target="_blank">{{ $report['label'] }}</a>
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
@endif
@if ( $type == "seller_dashboard" || $type == "admin_activities" )
    <div class="modal fade hahaha" id="{{ $key }}">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Report: {{ $title }}</h5>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="form-group row">
                            <div class="col-12">
                                <div class="dropdown">
                                    <button class="btn btn-default dropdown-toggle w-100" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Report Type
                                    </button>
                                    <div class="dropdown-menu w-100">
                                        @foreach( $reports as $report )
                                            <a class="dropdown-item" href="{{ $report['href'] }}" target="_blank">{{ $report['label'] }}</a>
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
@endif