@extends('sellerPanel.front')
@section('content')

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
                            <a class="nav-link" data-toggle="tab" href="#requests" role="tab" aria-expanded="false">Requests</a>
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
