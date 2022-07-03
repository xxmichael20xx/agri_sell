@extends('sellerPanel.front')
@section('content')
@php
    $_inc = [
        'csv_url' => '/export/csv/seller/refunds/current',
        'pdf_url' => '/export/pdf/seller/refunds/current',
        'key' => rand( 50, 1000 ),
        'is_seller' => true
    ];
@endphp
<style>
    .dropdown--right {
        left: unset !important;
        right: 0 !important;
        float: right !important;
    }
</style>
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-12 col-sm-4"></div>
                <div class="col-12 col-sm-4 mx-auto">
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
                                        <span class="badge badge-info">{{ $pendingRefunds }}</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-4 text-right">
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Report Generation
                        </button>
                        <div class="dropdown-menu dropdown--right">
                            <a class="dropdown-item" href="/export/csv/seller/refunds/full" target="_blank">CSV - Full List</a>
                            {{-- <a class="dropdown-item" href="/export/csv/seller/refunds/current" target="_blank">CSV - Current Month</a> --}}
                            {{-- <div class="dropdown-divider m-y-2"></div> --}}
                            <a class="dropdown-item" href="/export/pdf/seller/refunds/full" target="_blank">PDF - Full List</a>
                            {{-- <a class="dropdown-item" href="/export/pdf/seller/refunds/current" target="_blank">PDF - Current Month</a> --}}
                            @include( 'admin.export.months_trigger', $_inc )
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div id="my-tab-content" class="tab-content">
                        <div class="tab-pane active" id="confirmed" role="tabpanel" aria-expanded="true">
                            <div class="col-md-12">
                                @php
                                    $data = [];
                                    foreach ( $refunds as $index => $refund ) {
                                        if ( $refund->status == '3' ) {
                                            $data[] = $refund;
                                        }
                                    }
                                    $inc = array(
                                        "title" => "Confirmed refunds",
                                        "index" => 0,
                                        "data" => $data
                                    );
                                @endphp
                                @include( 'sellerPanel.refunds.table', $inc )
                            </div>
                        </div>
                        <div class="tab-pane" id="rejected" role="tabpanel" aria-expanded="false">
                            <div class="col-md-12">
                                @php
                                    $data = [];
                                    foreach ( $refunds as $index => $refund ) {
                                        if ( $refund->status == '4' ) {
                                            $data[] = $refund;
                                        }
                                    }
                                    $inc = array(
                                        "title" => "Rejected refunds",
                                        "index" => 1,
                                        "data" => $data
                                    );
                                @endphp
                                @include( 'sellerPanel.refunds.table', $inc )
                            </div>
                        </div>   
                        <div class="tab-pane" id="requests" role="tabpanel" aria-expanded="false">
                            <div class="col-md-12">
                                @php
                                    $data = [];
                                    foreach ( $refunds as $index => $refund ) {
                                        if ( $refund->status == '1' ) {
                                            $data[] = $refund;
                                        }
                                    }
                                    $inc = array(
                                        "title" => "Pending refunds",
                                        "index" => 2,
                                        "data" => $data
                                    );
                                @endphp
                                @include( 'sellerPanel.refunds.table', $inc )
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include( 'admin.export.months_modal', $_inc )
@endsection
@section( 'custom-scripts' )
    <script>
        (function($) {
            $(document).ready(function() {

                $( document ).on( 'click', '.view-images', function() {
                    const id = $( this ).data( 'id' )
                    const raw = $( this ).data( 'raw' )
                    const _slick = $( this ).parents( `#refund--container-${raw}` )

                    $( `#${id}` ).modal( 'show' )

                    _slick.find( $( '.refund--images' ) ).slick({
                        infinite: true,
                        slidesToShow: 1,
                        dots: false,
                        prevArrow: false,
                        nextArrow: false
                    })
                    _slick.find( $( '.refund--images .slick-track' ) ).css( 'width', '100% !important' )
                } )

            })
        })(jQuery)
    </script>
@endsection
