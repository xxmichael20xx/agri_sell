<div class="modal fade" id="{{ $key }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $modalTitle }}</h5>
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
                                    @foreach ( $reports as $report_url => $report )
                                        <a class="dropdown-item" href="{{ $report['url'] }}" target="_blank">{{ $report['label'] }}</a>
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