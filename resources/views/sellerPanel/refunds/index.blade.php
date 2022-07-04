@extends('sellerPanel.front')
@section('content')
@php
    $_inc = [
        'csv_url' => '/export/csv/seller/seller/refunds/current',
        'pdf_url' => '/export/pdf/seller/seller/refunds/current',
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
                            $exports = [
                                [
                                    'href' => '/export/csv/seller/refunds/confirmed/full',
                                    'label' => 'CSV'
                                ],
                                [
                                    'href' => '/export/pdf/seller/refunds/confirmed/full',
                                    'label' => 'PDF'
                                ],
                            ];
                            $addl = [
                                'type' => 'admin_refunds',
                                'key' => 'admin_refunds' . rand( 50, 1000 ) . '-confirmed',
                                'reports' => $exports,
                                'csv_url' => '/export/csv/seller/refunds/confirmed/current',
                                'pdf_url' => '/export/pdf/seller/refunds/confirmed/current',
                            ];
                            $inc = array(
                                "title" => "Confirmed refunds",
                                "index" => 0,
                                "data" => $data,
                                "exports" => $exports,
                                "inc" => $addl
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
                            $exports = [
                                [
                                    'href' => '/export/csv/seller/refunds/rejected/full',
                                    'label' => 'CSV'
                                ],
                                [
                                    'href' => '/export/pdf/seller/refunds/rejected/full',
                                    'label' => 'PDF'
                                ],
                            ];
                            $addl = [
                                'type' => 'admin_refunds',
                                'key' => 'admin_refunds' . rand( 50, 1000 ) . '-rejected',
                                'reports' => $exports,
                                'csv_url' => '/export/csv/seller/refunds/rejected/current',
                                'pdf_url' => '/export/pdf/seller/refunds/rejected/current',
                            ];
                            $inc = array(
                                "title" => "Rejected refunds",
                                "index" => 1,
                                "data" => $data,
                                "exports" => $exports,
                                "inc" => $addl
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
                            $exports = [
                                [
                                    'href' => '/export/csv/seller/refunds/requests/full',
                                    'label' => 'CSV'
                                ],
                                [
                                    'href' => '/export/pdf/seller/refunds/requests/full',
                                    'label' => 'PDF'
                                ],
                            ];
                            $addl = [
                                'type' => 'admin_refunds',
                                'key' => 'admin_refunds' . rand( 50, 1000 ) . '-requests',
                                'reports' => $exports,
                                'csv_url' => '/export/csv/seller/refunds/requests/current',
                                'pdf_url' => '/export/pdf/seller/refunds/requests/current',
                            ];
                            $inc = array(
                                "title" => "Pending refunds",
                                "index" => 2,
                                "data" => $data,
                                "exports" => $exports,
                                "inc" => $addl
                            );
                        @endphp
                        @include( 'sellerPanel.refunds.table', $inc )
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
