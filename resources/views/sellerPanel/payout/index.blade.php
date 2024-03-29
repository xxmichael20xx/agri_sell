@extends('sellerPanel.front')
@section('content')
<style>
    #myTab li.nav-item .nav-link.active::before,
    #myTab li.nav-item .nav-link.active::after {
        bottom: 0px !important;
    }

    .border-agri {
        border-color: #28A745 !important;
    }
</style>
<div class="content">
    <div class="form-group row">
        <div class="col-12">
            @if( session()->has( 'info' ) )
                <div class="alert alert-info">
                    <i class="fa fa-info-circle"></i> {{ session()->get('info') }}
                </div>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4 class="card-title">Payouts</h4>

                    <div class="d-flex">
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Report Generation
                            </button>
                            <div class="dropdown-menu dropdown--right">
                                @php
                                    $exports = [
                                        [
                                            'href' => '/export/csv/seller/payouts/full',
                                            'label' => 'CSV'
                                        ],
                                        [
                                            'href' => '/export/pdf/seller/payouts/full',
                                            'label' => 'PDF'
                                        ],
                                    ];
                                    $inc = [
                                        'type' => 'seller_payout',
                                        'key' => 'seller_payout' . rand( 50, 1000 ),
                                        'is_seller' => true,
                                        'reports' => $exports,
                                        'csv_url' => '/export/csv/seller/payouts/current',
                                        'pdf_url' => '/export/pdf/seller/payouts/current',
                                    ];
                                @endphp
                                @include( 'admin.export.modal_trigger', $inc )
                                @include( 'admin.export.months_trigger', $inc )
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary request-payout" data-user-id="{{ Auth::user()->id }}">Request Payout</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="seller--payout-table" class="table " cellspacing="0" width="100%">
                            <thead class=" text-primary">
                                <tr>
                                    <th>
                                        Amount
                                    </th>
                                    <th>
                                        Week range
                                    </th>
                                    <th>
                                        Date Requested
                                    </th>
                                    <th>
                                        Status
                                    </th>
                                    <th>
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ( $payouts as $index => $payout )
                                    @php
                                        $amount = $payout->amount;

                                        if ( $payout->metadata && $payout->metadata['type'] == 'Remit' ) {
                                            $remitt_amount = isset( $payout->metadata['remitt_amount'] ) ? $payout->metadata['remitt_amount'] : 0;
                                            $amount += intval( $remitt_amount );
                                        }
                                    @endphp
                                    <tr>
                                        <td>
                                            ₱ {{ AppHelpers::numeric( $amount ) }}
                                        </td>
                                        <td>
                                            {{ AppHelpers::humanDate( $payout->payout->week_start, false ) }} - {{ AppHelpers::humanDate( $payout->payout->week_end, false ) }}
                                        </td>
                                        <td>
                                            {{ AppHelpers::humanDate( $payout->created_at ) }}
                                        </td>
                                        <td>
                                            @if ( $payout->status == '0' )
                                                <span class="badge badge-info">PENDING</span>
                                            @elseif ( $payout->status == '1' )
                                                <span class="badge badge-success">CONFIRMED</span>
                                            @else
                                                <span class="badge badge-warning">REJECTED</span>
                                                Reason: {{ $payout->reject_reason }}
                                            @endif
                                        </td>
                                        <td>
                                            <a href="/sellerpanel/payout/show/{{ $payout->id }}" class="btn btn-sm btn-primary text-white m-1">More info</a>

                                            @if ( $payout->status == '2' )
                                                <a href="/sellerpanel/payout/new/{{ $payout->id }}" class="btn btn-sm btn-secondary text-white m-1">Update</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-12">
                            <h6>Reminders:</h6>
                            <ol class="pl-3">
                                <li>To process your payout request, make sure that you have an existing verified account in Gcash/Bank Account. </li>
                                <li>Please be advised that seller payout will not be processed everyday. Processing will resume every 3 days</li>
                                <li>Agrisell will only be able to process payouts via Seller Total Sales. </li>
                            </ol>
                        </div>

                        <div class="col-12">
                            <p>
                                Agriseller fees are charged to sellers for every successful order made. The seller fees consist of shipping fees.
                                <br>
                                Sample of how payouts are calculated:
                            </p>

                            <img src="{{ asset( 'assets/img/new_payout_sample_edited.jpg' ) }}" class="img-fluid w-75">
                        </div>

                        {{-- <div class="col-12">
                            <p class="mb-0">Sample image below:</p>
                            <img src="{{ asset( 'assets/img/payout_sample.png' ) }}" class="img-fluid">
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="payout-steps" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Payout Request Steps</h5>
            </div>
            <div class="modal-content">
                <div class="container-fluid">
                    <div class="form-group row">
                        <div class="col-12">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="step-1-tab" data-href="#step-1" role="tab" aria-controls="step-1" aria-selected="true">STEP 1</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="step-2-tab" data-href="#step-2" role="tab" aria-controls="step-2" aria-selected="true">STEP 2</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="step-3-tab" data-href="#step-3" role="tab" aria-controls="step-3" aria-selected="true">STEP 3</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="form-group row py-2">
                        <div class="col-11 mx-auto px-0">
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane active" id="step-1" role="tabpanel" aria-labelledby="step-1-tab">
                                    <span class="text-muted font-weight-bold">Form Validation</span>
                                    <ul class="pl-3">
                                        <li>Double-check the recipient’s name and mobile number.</li>
                                        <li>Please ensure that all the information is correct before proceeding to submission.</li>
                                    </ul>

                                    <br>
                                    <div class="text-right">
                                        <button type="button" class="btn btn-primary btn-next" data-id="#step-2-tab">Next</button>
                                    </div>
                                </div>
                                <div class="tab-pane" id="step-2" role="tabpanel" aria-labelledby="step-2-tab">
                                    <span class="text-muted font-weight-bold">Sales Check</span>
                                    <ul class="pl-3">
                                        <li>Check the available sales balance carefully, payout request cannot exceed the sales balance.</li>
                                    </ul>

                                    <br>
                                    <div class="text-right">
                                        <button type="button" class="btn btn-primary btn-next" data-id="#step-3-tab">Next</button>
                                    </div>
                                </div>
                                <div class="tab-pane" id="step-3" role="tabpanel" aria-labelledby="step-3-tab">
                                    <span class="text-muted font-weight-bold">Admins Approval</span>
                                    <ul class="pl-3">
                                        <li>Kindly wait within 24-48 hours for the admin to process your payout that will be sent to your Gcash/Bank Account or Money Remittance.</li>
                                    </ul>

                                    <hr>
                                    
                                    <div class="text-right">
                                        <button type="button" class="btn btn-secondary btn-dismiss" data-dismiss="modal">Cancel</button>
                                        <button type="button" class="btn btn-primary btn-agree">Agree</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include( 'admin.export.modal_content', $inc )
@include( 'admin.export.months_modal', $inc )
@endsection
@section( 'custom-scripts-addl' )
    <script>
        (function($) {
            $(document).ready(function() {

                let next = false

                $( '#seller--payout-table' ).DataTable()

                $( document ).on( 'click', '.request-payout', function() {
                    const user_id = $( this ).data( 'user-id' )
                    const body = {
                        user_id: user_id
                    }

                    const loading = Swal.fire({
                        title: 'Verifying payouts',
                        allowOutsideClick: false,
                        onBeforeOpen: () => {
                            Swal.showLoading()
                        }
                    })

                    fetch( `/api/seller/payout/verify`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify( body )
                    } ).then( r => r.json() ).then( res => {
                        loading.close()

                        setTimeout( () => {
                            if ( ! res.success ) {
                                Swal.fire({
                                    icon: 'info',
                                    title: 'Unable to request payout',
                                    text: `You’ve already requested your payout. Payout request process is every 3 days.`
                                })

                            } else {
                                $( '#payout-steps' ).modal( 'show' )
                            }
                        } )
                    } )
                } )

                $( document ).on( 'click', '.btn-agree', function() {
                    let date = new Date()
                    date.setTime( date.getTime() + ( 10 * 60 * 1000 ) )
                    let expires = "; expires="+date.toGMTString()
                    document.cookie = `payout_agree=Agree; ${expires}`

                    window.location.href = "/sellerpanel/payout/new"
                } )

                $( document ).on( 'click', '.btn-dismiss', function() {
                    const id = '#step-1-tab'
                    triggerTab( id )
                } )

                $( document ).on( 'click', '.btn-next', function() {
                    const id = $( this ).data( 'id' )
                    triggerTab( id )
                } )

                function triggerTab( id ) {
                    const tab = $( id )
                    const href = tab.data( 'href' )
                    tab.attr( 'href', href )
                    tab.attr( 'data-toggle', 'tab' )
                    tab.trigger( 'click' )
                    tab.removeAttr( 'data-toggle' )
                    tab.removeAttr( 'href' )
                    tab.attr( 'data-href', href )
                }

            })
        })(jQuery)
    </script>
@endsection
