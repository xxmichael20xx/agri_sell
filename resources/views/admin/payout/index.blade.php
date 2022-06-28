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
                            $exports = [
                                [
                                    'href' => '/export/csv/payouts/1/full',
                                    'label' => 'CSV - Full Report'
                                ],
                                [
                                    'href' => '/export/pdf/payouts/1/full',
                                    'label' => 'PDF - Full Report'
                                ],
                                [
                                    'href' => '/export/csv/payouts/1/current',
                                    'label' => 'CSV - Current Month'
                                ],
                                [
                                    'href' => '/export/pdf/payouts/1/current',
                                    'label' => 'PDF - Current Month'
                                ],
                            ];
                            $inc = array(
                                "title" => "Confirmed payouts",
                                "index" => 0,
                                "data" => $data,
                                "exports" => $exports
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
                            $exports = [
                                [
                                    'href' => '/export/csv/payouts/2/full',
                                    'label' => 'CSV - Full Report'
                                ],
                                [
                                    'href' => '/export/pdf/payouts/2/full',
                                    'label' => 'PDF - Full Report'
                                ],
                                [
                                    'href' => '/export/csv/payouts/2/current',
                                    'label' => 'CSV - Current Month'
                                ],
                                [
                                    'href' => '/export/pdf/payouts/2/current',
                                    'label' => 'PDF - Current Month'
                                ],
                            ];
                            $inc = array(
                                "title" => "Rejected payouts",
                                "index" => 1,
                                "data" => $data,
                                "exports" => $exports
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
                            $exports = [
                                [
                                    'href' => '/export/csv/payouts/0/full',
                                    'label' => 'CSV - Full Report'
                                ],
                                [
                                    'href' => '/export/pdf/payouts/0/full',
                                    'label' => 'PDF - Full Report'
                                ],
                                [
                                    'href' => '/export/csv/payouts/0/current',
                                    'label' => 'CSV - Current Month'
                                ],
                                [
                                    'href' => '/export/pdf/payouts/0/current',
                                    'label' => 'PDF - Current Month'
                                ],
                            ];
                            $inc = array(
                                "title" => "Pending payouts",
                                "index" => 2,
                                "data" => $data,
                                "exports" => $exports
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
