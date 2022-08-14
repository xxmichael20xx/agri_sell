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
        <div class="col-12 col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Payout Request details</h5>
                </div>
                <div class="card-body">
                    @php
                        $numberLabel = 'GCash number';
                        $is_remittance = false;

                        if ( $payout->metadata && isset( $payout->metadata['type'] ) ) {
                            $type = $payout->metadata['type'];

                            if ( $type == 'GCash' ) {
                                $numberLabel = 'GCash number';

                            } else if ( $type == 'Bank' ) {
                                $numberLabel = 'Bank number';

                            } else {
                                $numberLabel = 'Number';
                                $is_remittance = true;
                            }
                        }
                    @endphp
                    <div class="form-group row">
                        <div class="col-12 mb-3">
                            <span class="text-muted"><span class="dark-highlight">Seller name:</span> {{ $payout->seller->name }}</span>
                        </div>
                        <div class="col-12 mb-3">
                            <span class="text-muted"><span class="dark-highlight">{{ $payout->metadata['type'] ?? 'GCash' }} name:</span> {{ $payout->gcash_name }}</span>
                        </div>
                        <div class="col-12 mb-3">
                            <span class="text-muted"><span class="dark-highlight">{{ $numberLabel }}:</span> {{ $payout->gcash_number }}</span>
                        </div>
                        @if ( $payout->metadata && $payout->metadata['type'] == 'Bank' )
                            <div class="col-12 mb-3">
                                <span class="text-muted"><span class="dark-highlight">Bank Account:</span> {{ $payout->metadata['option'] }}</span>
                            </div>
                        @endif
                        @if ( $payout->metadata && $payout->metadata['type'] == 'Remit' )
                            <div class="col-12 mb-3">
                                <span class="text-muted"><span class="dark-highlight">Address:</span> {{ $payout->metadata['address'] }}</span>
                            </div>
                        @endif
                        {{-- <div class="col-12 mb-3">
                            <span class="text-muted">GCash reference number: {{ $payout->gcash_ref }}</span>
                        </div> --}}
                        <div class="col-12 mb-3">
                            <span class="text-muted">
                                <span class="dark-highlight">Amount:</span> ₱ {{ AppHelpers::numeric( $payout->amount ) }}
                                @if ( $is_remittance && isset( $payout->metadata['remitt_amount'] ) )
                                    (additional ₱{{ AppHelpers::numeric( $payout->metadata['remitt_amount'] ) }})
                                @endif
                            </span>
                        </div>
                        @if ( $payout->status == '2' )
                            <div class="col-12 mb-3">
                                <span class="text-muted"><span class="dark-highlight">Reason for rejecting:</span> {{ $payout->reject_reason }}</span>
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
