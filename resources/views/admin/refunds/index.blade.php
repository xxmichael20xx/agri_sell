@extends('admin.front')
@section('content')
@php
    $counter = 0;
    foreach ( $refunds as $index => $refund ) {
        if ( $refund->status == '0' ) $counter++;
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
                                <span class="badge badge-info">{{ $counter }}</span>
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
                                if ( $refund->status == '1' || $refund->status == '3' ) {
                                    $data[] = $refund;
                                }
                            }
                            $exports = [
                                [
                                    'href' => '/export/csv/refunds/confirmed/full',
                                    'label' => 'CSV - Full Report'
                                ],
                                [
                                    'href' => '/export/pdf/refunds/confirmed/full',
                                    'label' => 'PDF - Full Report'
                                ],
                                /* [
                                    'href' => '/export/csv/refunds/confirmed/current',
                                    'label' => 'CSV - Current Month'
                                ],
                                [
                                    'href' => '/export/pdf/refunds/confirmed/current',
                                    'label' => 'PDF - Current Month'
                                ] */
                            ];
                            $addl = [
                                'csv_url' => '/export/csv/refunds/confirmed/current',
                                'pdf_url' => '/export/pdf/refunds/confirmed/current',
                                'key' => rand( 50, 1000 )
                            ];
                            $inc = array(
                                "title" => "Confirmed refunds",
                                "index" => 0,
                                "data" => $data,
                                "exports" => $exports,
                                "inc" => $addl
                            );
                        @endphp
                        @include( 'admin.refunds.table', $inc )
                    </div>
                </div>
                <div class="tab-pane" id="rejected" role="tabpanel" aria-expanded="false">
                    <div class="col-md-12">
                        @php
                            $data = [];
                            foreach ( $refunds as $index => $refund ) {
                                if ( $refund->status == '2' || $refund->status == '4' ) {
                                    $data[] = $refund;
                                }
                            }
                            $exports = [
                                [
                                    'href' => '/export/csv/refunds/rejected/full',
                                    'label' => 'CSV - Full Report'
                                ],
                                [
                                    'href' => '/export/csv/refunds/rejected/current',
                                    'label' => 'CSV - Current Month'
                                ],
                                /* [
                                    'href' => '/export/pdf/refunds/rejected/full',
                                    'label' => 'PDF - Full Report'
                                ],
                                [
                                    'href' => '/export/pdf/refunds/rejected/current',
                                    'label' => 'PDF - Current Month'
                                ], */
                            ];
                            $addl = [
                                'csv_url' => '/export/csv/refunds/rejected/current',
                                'pdf_url' => '/export/pdf/refunds/rejected/current',
                                'key' => rand( 50, 1000 )
                            ];
                            $inc = array(
                                "title" => "Rejected refunds",
                                "index" => 1,
                                "data" => $data,
                                "exports" => $exports,
                                "inc" => $addl
                            );
                        @endphp
                        @include( 'admin.refunds.table', $inc )
                    </div>
                </div>   
                <div class="tab-pane" id="requests" role="tabpanel" aria-expanded="false">
                    <div class="col-md-12">
                        @php
                            $data = [];
                            foreach ( $refunds as $index => $refund ) {
                                if ( $refund->status == '0' ) {
                                    $data[] = $refund;
                                }
                            }
                            $exports = [
                                [
                                    'href' => '/export/csv/refunds/requests/full',
                                    'label' => 'CSV - Full Report'
                                ],
                                [
                                    'href' => '/export/pdf/refunds/rejected/full',
                                    'label' => 'PDF - Full Report'
                                ],
                                /* [
                                    'href' => '/export/csv/refunds/requests/current',
                                    'label' => 'CSV - Current Month'
                                ],
                                [
                                    'href' => '/export/pdf/refunds/rejected/current',
                                    'label' => 'PDF - Current Month'
                                ], */
                            ];
                            $addl = [
                                'csv_url' => '/export/csv/refunds/requests/current',
                                'pdf_url' => '/export/pdf/refunds/requests/current',
                                'key' => rand( 50, 1000 )
                            ];
                            $inc = array(
                                "title" => "Pending refunds",
                                "index" => 2,
                                "data" => $data,
                                "exports" => $exports,
                                "inc" => $addl
                            );
                        @endphp
                        @include( 'admin.refunds.table', $inc )
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
