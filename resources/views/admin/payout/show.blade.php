@extends('admin.front')
@section('content')
<style>
    .dropdown.bootstrap-select {
        width: 100% !important;
    }
    .border-dotted {
        border-style: dotted !important;
    }
</style>
<div class="content">
    <a href="/admin/payout/" class="btn btn-outline-dark btn-round mb-4">Go back</a>

    <div class="row">
        <div class="col-12 col-md-7">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Payout Request details</h5>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-12 mb-3">
                            <span class="text-muted">Seller name: {{ $payout->seller->name }}</span>
                        </div>
                        <div class="col-12 mb-3">
                            <span class="text-muted">GCash name: {{ $payout->gcash_name }}</span>
                        </div>
                        <div class="col-12 mb-3">
                            <span class="text-muted">GCash number: {{ $payout->gcash_number }}</span>
                        </div>
                        <div class="col-12 mb-3">
                            <span class="text-muted">GCash reference number: {{ $payout->gcash_ref }}</span>
                        </div>
                        <div class="col-12 mb-3">
                            <span class="text-muted">Amount: ₱ {{ AppHelpers::numeric( $payout->amount ) }}</span>
                        </div>
                        @if ( $payout->status == '2' )
                            <div class="col-12 mb-3">
                                <span class="text-muted">Reason for rejecting: {{ $payout->reject_reason }}</span>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="card-footer">
                    @if ( $payout->status == '0' )
                        <button type="buttom" class="btn btn-outline-info btn-round m-1 text-danger" data-toggle="modal" data-target="#reject-modal">Reject Payout</button>
                        <button type="buttom" class="btn btn-outline-info btn-round m-1 text-info btn-action" data-action="confirm" data-id="{{ $payout->id }}">Confirm Payout</button>

                        <div class="modal fade" id="reject-modal">
                            <div class="modal-dialog modal-lg">
                                <form method="POST" id="reject--payout-form">
                                    @csrf
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Reject Payout Request</h5>
                                        </div>
                                        <div class="modal-content">
                                            <div class="container-fluid py-5">
                                                <div class="form-group row">
                                                    <div class="col-12">
                                                        <label for="reject_reason" class="col-form-label">Select a reason:</label>
                                                        <select name="reject_reason" id="reject_reason" class="custom-select" required>
                                                            <option value="" selected disabled>Select an option</option>
                                                            <option value="Unverified GCash name/number">Unverified GCash name/number</option>
                                                            <option value="Invalid GCash number">Invalid GCash number</option>
                                                            <option value="Payout amount exceeded your sales">Payout amount exceeded your sales</option>
                                                            <option value="Others">Others</option>
                                                        </select>
                                                        <textarea name="reject_reason_other" id="reject_reason_other" rows="5" class="form-control mt-3 collapse" placeholder="Please provided a reason for rejecting this payout request."></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal">Cancel</button>
                                            <button type="button" class="btn btn-primary collapse btn-trigger" id="btn-trigger" data-action="reject" data-id="{{ $payout->id }}">Submit</button>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section( 'admin.custom_scripts' )
    <script>
        (function($) {
            $(document).ready(function() {

                $( document ).on( 'change', '#reject_reason', function() {
                    const val = $( this ).val()
                    const other = $( '#reject_reason_other' )

                    if ( val == "Others" ) {
                        other.show()
                        other.attr( 'required', true )

                    } else {
                        other.hide()
                        other.val( '' )
                        other.attr( 'required', false )
                    }
                } )

                $( document ).on( 'submit', '#reject--payout-form', function( e ) {
                    e.preventDefault()
                    $( '#btn-trigger' ).click()
                } )

                $( document ).on( 'click', '.btn-action, .btn-trigger', function() {
                    let text = 'Payout request will be confirmed!'
                    let status = 1
                    const action = $( this ).data( 'action' )
                    const id = $( this ).data( 'id' )
                    const user_id = '{{ Auth::user()->id }}'
                    let reason = $( '#reject_reason' ).val()
                    let other = $( '#reject_reason_other' ).val()

                    if ( other ) reason += `: ${other}`
                    if ( action == 'reject' ) {
                        text = 'Payout will be rejected!'
                        status = 2
                    }

                    const href = `/api/admin/payout/update`
                    const body = {
                        user_id: user_id,
                        status: status,
                        reason: reason,
                        id: id
                    }

                    Swal.fire( {
                        icon: 'info',
                        title: 'Are you sure?',
                        text: text,
                        showCancelButton: true,
                        showConfirmButton: true,
                        confirmButtonColor: '#dc3545',
                        confirmButtonText: 'Confirm'
                    } ).then( ( event ) => {
                        if ( event.value ) {

                            $( '#reject-modal' ).modal( 'hide' )
                            const loading = Swal.fire({
                                title: 'Processing update',
                                allowOutsideClick: false,
                                onBeforeOpen: () => {
                                    Swal.showLoading()
                                }
                            })

                            fetch( href, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json'
                                },
                                body: JSON.stringify( body )
                            } ).then( r => r.json() ).then( res => {
                                loading.close()

                                setTimeout( () => {
                                    Swal.fire({
                                        icon: res.success ? 'success' : 'info',
                                        title: res.message
                                    }).then( () => {
                                        window.location.href = "/admin/payout/"
                                    } )
                                } )
                            } )
                        }
                    } )
                } )
            })
        })(jQuery)
    </script>
@endsection
