@extends('sellerPanel.front')
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
    <a href="/sellerpanel/payout" class="btn btn-outline-dark btn-round mb-4">Go back</a>

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
            </div>
        </div>
    </div>
</div>

@endsection
@section( 'admin.custom_scripts' )
    <script>
        (function($) {
            $(document).ready(function() {
                
                // 
                
            })
        })(jQuery)
    </script>
@endsection
