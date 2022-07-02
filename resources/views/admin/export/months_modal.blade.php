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
$handle = isset( $is_seller ) ? 'custom-scripts' : 'admin.custom_scripts';
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
                            <select name="select-type" class="custom-select select-type" data-key="{{ $key }}">
                                <option value="" selected disabled>Select an option</option>
                                <option value="csv">CSV</option>
                                <option value="pdf">PDF</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row collapse" id="report-csv-{{ $key }}">
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
                    <div class="form-group row collapse" id="report-pdf-{{ $key }}">
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
@section($handle)
    <script>
        (function($) {
            window.onload = () => {

                $( document ).on( 'change', '.select-type', function() {
                    const key = $( this ).data( 'key' )
                    const val = $( this ).val()

                    if ( val == 'csv' ) {
                        $( `#report-csv-${key}` ).removeClass( 'collapse' )
                        $( `#report-pdf-${key}` ).addClass( 'collapse' )

                    } else {
                        $( `#report-csv-${key}` ).addClass( 'collapse' )
                        $( `#report-pdf-${key}` ).removeClass( 'collapse' )
                    }
                } )

            }
        })(jQuery)
    </script>
@endsection