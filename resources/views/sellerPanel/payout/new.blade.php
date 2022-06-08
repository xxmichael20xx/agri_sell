@extends('sellerPanel.front')
@section('content')

<div class="content">
    <a href="/sellerpanel/payout" class="btn btn-outline-dark btn-round mb-4">Go back</a>

    <div class="row">
        <div class="col-12 col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Payout Request Form {{ $payout ? "- Update" : "" }}</h5>
                </div>
                <div class="card-body">
                    <form method="POST" id="payout--request-form">
                        @csrf
                        <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
                        @if ( $payout )
                            <input type="hidden" name="payout_request_id" id="payout_request_id" value="{{ $payout->id }}">
                        @endif

                        <div class="form-group row">
                            <div class="col-12">
                                <div class="h6">GCash Verified Information</div>
                            </div>
                        </div>

                        <div id="first-fields">
                            <div class="form-group row">
                                <div class="col-2">
                                    <label class="col-form-label">GCash Name:</label>
                                </div>
                                <div class="col-10">
                                    <div class="form-group row">
                                        <div class="col">
                                            <input type="text" name="gcash_first_name" id="gcash_first_name" class="form-control" placeholder="First name: i.e. John" value="{{ $payout->gcash_first_name ?? '' }}" required>
                                            <small class="text-danger collapse">First name is required</small>
                                        </div>
                                        <div class="col">
                                            <input type="text" name="gcash_last_name" id="gcash_last_name" class="form-control" placeholder="Last nae: i.e. Doe" value="{{ $payout->gcash_last_name ?? '' }}" required>
                                            <small class="text-danger collapse">Last name is required</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-2">
                                    <label for="gcash_number" class="col-form-label">GCash Number:</label>
                                </div>
                                <div class="col-10">
                                    <input type="tel" name="gcash_number" id="gcash_number" class="form-control" placeholder="i.e. +6399151118383" value="{{ $payout->gcash_number ?? '' }}" required>
                                    <small class="text-danger collapse">GCash Number is required</small>
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
                                    <button type="button" class="btn btn-primary btn-action" data-action="next">Next</button>
                                </div>
                            </div>
                        </div>

                        <div class="collapse" id="second-fields">
                            <div class="form-group row">
                                <div class="col-2">
                                    <label for="amount" class="col-form-label">Amount of Payout:</label>
                                </div>
                                <div class="col-10">
                                    <input type="number" name="amount" id="amount" class="form-control" placeholder="i.e. 200" value="{{ $payout->amount ?? '' }}" required>
                                    <small class="text-danger collapse">Payout amount is required</small>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-2">
                                    <label for="payout_password" class="col-form-label">Password:</label>
                                </div>
                                <div class="col-10">
                                    <input type="password" name="payout_password" id="payout_password" class="form-control" required>
                                    <small class="text-danger collapse">Password is required</small>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-12">
                                    <button type="button" class="btn btn-secondary btn-action" data-action="back">Back</button>
                                    <button type="button" class="btn btn-primary btn-action" data-action="submit">Validate Form</button>
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

                $( document ).on( 'click', '.btn-action', function() {
                    const action = $( this ).data( 'action' )
                    const first = $( '#first-fields' )
                    const second = $( '#second-fields' )
                    let proceed = false

                    if ( action == 'next' ) {
                        let firstName = $( '#gcash_first_name' )
                        let lastName = $( '#gcash_last_name' )
                        let gnumber = $( '#gcash_number' )
                        // let gref = $( '#gcash_ref' )

                        let afterValidate = [ validate( firstName ), validate( lastName ), validate( gnumber ) ]
                        let proceed = afterValidate.includes( false ) ? false : true

                        if ( proceed ) {
                            const reg = new RegExp( /^09[0-9]{9,9}$/i )
                            const isValid = reg.test( gnumber.val() )

                            if ( ! isValid ) {
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Opps, there seems to be a problem',
                                    html: 'Please enter a valid Phone Number'
                                })
                                return false
                            }

                            first.hide()
                            second.show()
                        }

                    } else if ( action == 'back' ) {
                        first.show()
                        second.hide()

                    } else {
                        let proceed = triggerVerify()
                        if ( proceed ) verifyForm()
                        
                    }
                } )

                $( document ).on( 'submit', '#payout--request-form', function( e ) {
                    e.preventDefault()
                } )

                function validate( el, isNum = false ) {
                    const val = el.val()

                    if ( ! val ) {
                        if ( isNum ) {
                            el.next().text( 'Payout amount is required' )
                        }

                        el.next().show()
                        return false

                    } else {
                        if ( isNum ) {
                            if ( val < 100 ) {
                                el.next().text( 'Payout amount must be greater than 100' )
                                el.next().show()
                                return false
                            }
                        }

                        el.next().hide()
                        return true
                    }
                }

                function triggerVerify() {
                    let payoutAmount = $( '#amount' )
                    let payoutPassword = $( '#payout_password' )
                    
                    let afterValidate = [ validate( payoutAmount, true ), validate( payoutPassword ) ]
                    let proceed = afterValidate.includes( false ) ? false : true
                    return proceed
                }

                function verifyForm() {
                    const form = new FormData( $( '#payout--request-form' )[0] )
                    // const payoutRef = form.get( 'gcash_ref' )
                    const amount = form.get( 'amount' )
                    const password = form.get( 'payout_password' )
                    const number = form.get( 'gcash_number' )
                    const user_id = {{ Auth::user()->id }}
                    const body = {
                        user_id: user_id,
                        // payoutRef: payoutRef,
                        amount: amount,
                        password: password,
                        number: number
                    }

                    const loading = Swal.fire({
                        title: 'Validation form',
                        allowOutsideClick: false,
                        onBeforeOpen: () => {
                            Swal.showLoading()
                        }
                    })

                    fetch( `/api/seller/payout/validation`, {
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
                                    icon: 'warning',
                                    title: 'Opps, there seems to be a problem',
                                    html: res.message
                                })

                            } else {
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'PROCEED PAYOUT REQUEST',
                                    html: `
                                        Note: You can only request for payout every 7 day!
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
                    } ).catch( e => {
                        loading.close()
                    } )
                }

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