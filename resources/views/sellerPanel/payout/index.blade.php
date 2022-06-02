@extends('sellerPanel.front')
@section('content')

<style>
    #myTab li.nav-item .nav-link.active::before,
    #myTab li.nav-item .nav-link.active::after {
        bottom: 0px !important;
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

                    <button type="button" class="btn btn-primary request-payout" data-user-id="{{ Auth::user()->id }}">Request Payout</button>
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
                                    <tr>
                                        <td>
                                            ₱ {{ AppHelpers::numeric( $payout->amount ) }}
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
                                            @elseif ( $payout->status == '1')
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
                    <h6>Reminders:</h6>
                    <ol class="pl-3">
                        <li>First Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos, eius.</li>
                        <li>Second Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere atque labore magnam consectetur? Neque facere nostrum consectetur molestias excepturi vel!</li>
                        <li>Third Lorem ipsum dolor sit amet.</li>
                    </ol>
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
                                    <a class="nav-link active" id="step-1-tab" data-toggle="tab" href="#step-1" role="tab" aria-controls="step-1" aria-selected="true">Step 1</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="step-2-tab" data-toggle="tab" href="#step-2" role="tab" aria-controls="step-2" aria-selected="true">Step 2</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="step-3-tab" data-toggle="tab" href="#step-3" role="tab" aria-controls="step-3" aria-selected="true">Step 3</a>
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
                                    <ol class="pl-3">
                                        <li>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aut, dolore.</li>
                                        <li>Lorem ipsum dolor sit amet consectetur.</li>
                                        <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatem aperiam hic possimus libero ipsam reprehenderit dolores, sit, ullam ipsum ducimus debitis voluptatum incidunt iste laudantium?</li>
                                    </ol>
                                </div>
                                <div class="tab-pane" id="step-2" role="tabpanel" aria-labelledby="step-2-tab">
                                    <span class="text-muted font-weight-bold">Sales Check</span>
                                    <ol class="pl-3">
                                        <li>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aut, dolore.</li>
                                        <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatem aperiam hic possimus libero ipsam reprehenderit dolores, sit, ullam ipsum ducimus debitis voluptatum incidunt iste laudantium?</li>
                                    </ol>
                                </div>
                                <div class="tab-pane" id="step-3" role="tabpanel" aria-labelledby="step-3-tab">
                                    <span class="text-muted font-weight-bold">Admins Approval</span>
                                    <ol class="pl-3">
                                        <li>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aut, dolore.</li>
                                        <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Non at asperiores, illum quos amet itaque repellat.</li>
                                    </ol>

                                    <hr>

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
@endsection
@section( 'custom-scripts' )
    <script>
        (function($) {
            $(document).ready(function() {

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
                                    text: `You've already requested your payout for this week.`
                                })

                            } else {
                                $( '#payout-steps' ).modal( 'show' )
                            }
                        } )
                    } )
                } )

                $( document ).on( 'click', '.btn-agree', function() {
                    let date = new Date()
                    date.setTime( date.getTime() + ( 5 * 60 * 1000 ) )
                    let expires = "; expires="+date.toGMTString()
                    document.cookie = `payout_agree=Agree; ${expires}`

                    window.location.href = "/sellerpanel/payout/new"
                } )

            })
        })(jQuery)
    </script>
@endsection
