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
<div class="modal fade" id="csvMonths-{{ $key }}">
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
                                        <a class="dropdown-item" href="{{ $csv_url }}/{{ $month_index + 1 }}" target="_blank">{{ $month }}</a>
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
                                        <a class="dropdown-item" href="{{ $pdf_url }}/{{ $month_index + 1 }}" target="_blank">{{ $month }}</a>
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