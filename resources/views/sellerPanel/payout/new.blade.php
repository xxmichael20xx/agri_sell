@extends('sellerPanel.front')
@section('content')
<style>
    .logo--image {
        width: 40px !important;
        height: 30px !important;
        margin-right: 10px;
    }
</style>
<div class="content">
    <a href="/sellerpanel/payout" class="btn btn-outline-dark btn-round mb-4">Go back</a>

    <div class="row">
        <div class="col-12 col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Payout Request Form {{ $payout ? "- Update" : "" }}</h5>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-6 text-right">
                            <button type="button" class="btn btn-outline-primary payout--type" data-value="GCash">
                                <img src="/img/gcash.png" class="img-fluid w-25 logo--image">
                                Add GCash Account
                            </button>
                        </div>
                        <div class="col-6">
                            <div class="dropdown">
                                <button class="btn btn-outline-primary dropdown-toggle" type="button" id="payoutOptionType" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img src="/img/bank.png" class="img-fluid w-25 logo--image">
                                    Add Bank Account
                                </button>
                                <div class="dropdown-menu" aria-labelledby="payoutOptionType">
                                    <a class="dropdown-item payout--type" href="#" data-value="Bank" data-bank="Unionbank Internet Banking">
                                        <img src="/img/union_bank.png" class="img-fluid w-25 logo--image">
                                        Unionbank Internet Banking
                                    </a>
                                    <a class="dropdown-item payout--type" href="#" data-value="Bank" data-bank="RCBC AccessOne">
                                        <img src="/img/rcbc.png" class="img-fluid w-25 logo--image">
                                        RCBC AccessOne
                                    </a>
                                    <a class="dropdown-item payout--type" href="#" data-value="Bank" data-bank="BDO">
                                        <img src="/img/bdo.png" class="img-fluid w-25 logo--image">
                                        BDO
                                    </a>
                                    <a class="dropdown-item payout--type" href="#" data-value="Bank" data-bank="Metrobank Direct">
                                        <img src="/img/metrobank.png" class="img-fluid w-25 logo--image">
                                        Metrobank Direct
                                    </a>
                                    <a class="dropdown-item payout--type" href="#" data-value="Bank" data-bank="Landbank ATM Online">
                                        <img src="/img/landbank.png" class="img-fluid w-25 logo--image">
                                        Landbank ATM Online
                                    </a>
                                    <a class="dropdown-item payout--type" href="#" data-value="Bank" data-bank="Bank of Commerce">
                                        <img src="/img/bank_of_commerce.png" class="img-fluid w-25 logo--image">
                                        Bank of Commerce
                                    </a>
                                    <a class="dropdown-item payout--type" href="#" data-value="Bank" data-bank="UCPB Connect">
                                        <img src="/img/ucpb.png" class="img-fluid w-25 logo--image">
                                        UCPB Connect
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form method="POST" id="payout--request-form" class="collapse">
                        @csrf
                        <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
                        <input type="hidden" name="payout_type" id="payout_type">
                        <input type="hidden" name="form_step" id="form_step" value="1">
                        @if ( $payout )
                            <input type="hidden" name="payout_request_id" id="payout_request_id" value="{{ $payout->id }}">
                        @endif

                        <div class="form-group row">
                            <div class="col-12">
                                <div class="h6"><span id="account--details"></span> Account Details</div>
                            </div>
                        </div>

                        <div id="first-fields">
                            <div class="form-group row collapse" id="payout--option-container">
                                <div class="col-2">
                                    <label class="col-form-label">Payment option:</label>
                                </div>
                                <div class="col-10">
                                    <select class="select custom-select" id="payout_option" name="payout_option">
                                        <option value="" selected disabled>Select payment option</option>
                                        <option value="Unionbank Internet Banking">Unionbank Internet Banking</option>
                                        <option value="RCBC AccessOne">RCBC AccessOne</option>
                                        <option value="BDO">BDO</option>
                                        <option value="Metrobank Direct">Metrobank Direct</option>
                                        <option value="Landbank ATM Online">Landbank ATM Online</option>
                                        <option value="Bank of Commerce">Bank of Commerce</option>
                                        <option value="UCPB Connect">UCPB Connect</option>
                                    </select>
                                    <small class="text-danger" id="payout_option_error"></small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-2">
                                    <label class="col-form-label"><span id="fields--name"></span> Name:</label>
                                </div>
                                <div class="col-10">
                                    <div class="form-group row">
                                        <div class="col">
                                            <input type="text" name="gcash_first_name" id="gcash_first_name" class="form-control" placeholder="First name: i.e. John" value="{{ $payout->gcash_first_name ?? '' }}">
                                            <small class="text-danger" id="gcash_first_name_error"></small>
                                        </div>
                                        <div class="col">
                                            <input type="text" name="gcash_last_name" id="gcash_last_name" class="form-control" placeholder="Last nae: i.e. Doe" value="{{ $payout->gcash_last_name ?? '' }}">
                                            <small class="text-danger" id="gcash_last_name_error"></small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-2">
                                    <label for="gcash_number" class="col-form-label"><span id="fields--number"></span> Number:</label>
                                </div>
                                <div class="col-10">
                                    <input type="tel" name="gcash_number" id="gcash_number" class="form-control" value="{{ $payout->gcash_number ?? '' }}">
                                    <small class="text-danger" id="gcash_number_error"></small>
                                </div>
                            </div>

                            {{-- <div class="form-group row">
                                <div class="col-2">
                                    <label for="gcash_ref" class="col-form-label">Ref. No.:</label>
                                </div>
                                <div class="col-10">
                                    <input type="text" name="gcash_ref" id="gcash_ref" class="form-control" placeholder="i.e. JOHN-DOE" value="{{ $payout->gcash_ref ?? '' }}" required>
                                    <small class="text-danger collapse">GCash Reference Number is required</small>
                                </div>
                            </div> --}}

                            <div class="form-group row">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Next</button>
                                </div>
                            </div>
                        </div>

                        <div class="collapse" id="second-fields">
                            <div class="form-group row">
                                <div class="col-2">
                                    <label for="amount" class="col-form-label">Amount of Payout:</label>
                                </div>
                                <div class="col-10">
                                    <input type="number" name="amount" id="amount" class="form-control" placeholder="i.e. 200" value="{{ $payout->amount ?? '' }}">
                                    <small class="text-danger" id="amount_error"></small>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-2">
                                    <label for="payout_password" class="col-form-label">Password:</label>
                                </div>
                                <div class="col-10">
                                    <input type="password" name="payout_password" id="payout_password" class="form-control">
                                    {{-- <p class="text-muted d-block">Please insert your seller account password, enable to process your payout request.</p> --}}
                                    <small class="text-danger" id="payout_password_error"></small>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-12">
                                    <button type="button" class="btn btn-secondary btn-back">Back</button>
                                    <button type="submit" class="btn btn-primary btn-action" data-action="submit">Validate Form</button>
                                </div>
                            </div>
                        </div>
                    </form>
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

                $( document ).on( 'click', '.payout--type', function() {
                    const val = $( this ).data( 'value' )
                    const bank = $( this ).data( 'bank' )
                    const self = this

                    $( '#payout--request-form' ).removeClass( 'collapse' )
                    $( '#account--details' ).text( val )
                    $( '#fields--name' ).text( val )
                    $( '#fields--number' ).text( val )

                    $( '#payout--request-form small.text-danger' ).each( function() {
                        $( this ).html( '' )
                    } )

                    if ( val.toLowerCase() !== $( '#payout_type' ).val() ) {
                        $( '#gcash_first_name' ).val( '' )
                        $( '#gcash_last_name' ).val( '' )
                        $( '#gcash_number' ).val( '' )
                    }

                    $( '#payout_type' ).val( val.toLowerCase() )
                    $( '#gcash_number' ).attr( 'placeholder', `Enter ${val} number` )

                    $( '.payout--type' ).each( function() {
                        $( this ).removeClass( 'btn-primary' )
                        $( this ).addClass( 'btn-outline-primary' )
                    } )

                    $( this ).addClass( 'btn-primary' )
                    $( this ).removeClass( 'btn-outline-primary' )

                    /* if ( val == "Bank" ) {
                        $( '#payout--option-container' ).removeClass( 'collapse' )
                    } else {
                        $( '#payout--option-container' ).addClass( 'collapse' )
                        $( '#payout_option' ).val( '' ).trigger( 'change' )
                    } */

                    if ( bank ) {
                        $( '#payout_option' ).val( bank ).trigger( 'change' )
                    } else {
                        $( '#payout_option' ).val( '' ).trigger( 'change' )
                    }
                } )

                $( document ).on( 'click', '.btn-back', function() {
                    $( '#form_step' ).val( 1 )
                    $( '#first-fields' ).removeClass( 'collapse' )
                    $( '#second-fields' ).addClass( 'collapse' )
                } )

                $( document ).on( 'submit', '#payout--request-form', function( e ) {
                    e.preventDefault()

                    const form = new FormData( $( this )[0] )
                    const data = JSON.stringify( Object.fromEntries( form ) )

                    $( '#payout--request-form small.text-danger' ).each( function() {
                        $( this ).html( '' )
                    } )

                    fetch( `/api/seller/payout/validation`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        },
                        body: data
                    } ).then( r => r.json() ).then( res => {
                        const errors = res.errors
                        const success = res.success

                        if ( errors ) {
                            Object.keys( errors ).forEach( ( key ) => {
                                const id = '#' + key + '_error'
                                const el = $( id )

                                el.html()
                                el.html( errors[key] )
                            } )
                        }

                        if ( success ) {
                            $( '#form_step' ).val( 2 )
                            $( '#first-fields' ).addClass( 'collapse' )
                            $( '#second-fields' ).removeClass( 'collapse' )
                        }

                        if ( success && res.message == 'Payout request continue' ) {
                            Swal.fire({
                                icon: 'warning',
                                title: 'PROCEED PAYOUT REQUEST',
                                html: `
                                    Note: You can only request for payout every 3 day!
                                `,
                                showCancelButton: true,
                                showConfirmButton: true,
                                confirmButtonColor: '#dc3545',
                                confirmButtonText: 'Yes',
                                cancelButtonText: 'No',
                                allowOutsideClick: false
                            }).then( ( event ) => {
                                if ( event.value ) createRequest()
                            })
                        }
                    } )
                } )

                function createRequest() {
                    const form = new FormData( $( '#payout--request-form' )[0] )
                    const loading = Swal.fire({
                        title: 'Processing request',
                        allowOutsideClick: false,
                        onBeforeOpen: () => {
                            Swal.showLoading()
                        }
                    })

                    fetch( `/api/seller/payout/new`, {
                        method: 'POST',
                        body: form
                    } ).then( r => r.json() ).then( res => {
                        loading.close()

                        setTimeout( () => {
                            Swal.fire({
                                icon: res.success ? 'success' : 'warning',
                                title: res.success ? 'Request submitted' : 'Request failed',
                                html: res.message
                            }).then( () => {
                                window.location.href = "/sellerpanel/payout"
                            } )
                        } )
                    } ).catch( e => {
                        loading.close()
                    } )
                }

            })
        })(jQuery)
    </script>
@endsection