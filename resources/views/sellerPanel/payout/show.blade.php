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
                            <span class="text-muted">{{ $payout->metadata['type'] ?? 'GCash' }} name: {{ $payout->gcash_name }}</span>
                        </div>
                        <div class="col-12 mb-3">
                            <span class="text-muted">{{ $payout->metadata['type'] ?? 'GCash' }} number: {{ $payout->gcash_number }}</span>
                        </div>
                        @if ( $payout->metadata && $payout->metadata['type'] == 'Bank' )
                            <div class="col-12 mb-3">
                                <span class="text-muted">Bank Account: {{ $payout->metadata['option'] }}</span>
                            </div>
                        @endif
                        {{-- <div class="col-12 mb-3">
                            <span class="text-muted">GCash reference number: {{ $payout->gcash_ref }}</span>
                        </div> --}}
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

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Proof of Payout</h5>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-12">
                            @if( $payout->status == 1 && $payout->image_proof )
                                <img src="/storage/{{ $payout->image_proof }}" class="img-fluid" />
                            @else
                                <div class="text-muted text-center">
                                    <i class="fa fa-info-circle"></i> No proof of payout yet.
                                </div>
                            @endif
                        </div>
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
