@extends('admin.front')
@section('content')
@php
    $pendingCount = 0;
    foreach ( $payouts as $index => $payout ) {
        if ( $payout->status == '0' ) {
            $pendingCount++;
        }
    }
@endphp

<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-navigation">
                <div class="nav-tabs-wrapper">
                    <ul id="tabs" class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#confirmed" role="tab" aria-expanded="true">Confirmed</a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#rejected" role="tab" aria-expanded="false">Rejected</a>
                        </li>
                        
                         <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#requests" role="tab" aria-expanded="false">
                                Requests
                                <span class="badge badge-info">{{ $pendingCount }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div id="my-tab-content" class="tab-content">
                <div class="tab-pane active" id="confirmed" role="tabpanel" aria-expanded="true">
                    <div class="col-md-12">
                        @php
                            $data = [];
                            foreach ( $payouts as $index => $payout ) {
                                if ( $payout->status == '1' ) {
                                    $data[] = $payout;
                                }
                            }
                            $inc = array(
                                "title" => "Confirmed payouts",
                                "index" => 0,
                                "data" => $data
                            );
                        @endphp
                        @include( 'admin.payout.table', $inc )
                    </div>
                </div>
                <div class="tab-pane" id="rejected" role="tabpanel" aria-expanded="false">
                    <div class="col-md-12">
                        @php
                            $data = [];
                            foreach ( $payouts as $index => $payout ) {
                                if ( $payout->status == '2' ) {
                                    $data[] = $payout;
                                }
                            }
                            $inc = array(
                                "title" => "Rejected payouts",
                                "index" => 1,
                                "data" => $data
                            );
                        @endphp
                        @include( 'admin.payout.table', $inc )
                    </div>
                </div>   
                <div class="tab-pane" id="requests" role="tabpanel" aria-expanded="false">
                    <div class="col-md-12">
                        @php
                            $data = [];
                            foreach ( $payouts as $index => $payout ) {
                                if ( $payout->status == '0' ) {
                                    $data[] = $payout;
                                }
                            }
                            $inc = array(
                                "title" => "Pending payouts",
                                "index" => 2,
                                "data" => $data
                            );
                        @endphp
                        @include( 'admin.payout.table', $inc )
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
