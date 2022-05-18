@extends('admin.front' )
@section('content' )

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
                            <a class="nav-link" data-toggle="tab" href="#cancelled" role="tab" aria-expanded="false">Cancelled</a>
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
                            $users = App\UserValidId::where('is_valid', 1)->get();
                            $datatable_index = "0";
                            $title = "Confirmed refunds";
                        @endphp
                        @include( 'admin.refunds.table' )
                    </div>
                </div>
                <div class="tab-pane" id="cancelled" role="tabpanel" aria-expanded="false">
                    <div class="col-md-12">
                        @php
                            $users = App\UserValidId::where('is_valid', 0)->get();
                            $datatable_index = "1";
                            $title = "Cancelled refunds";
                        @endphp
                        @include( 'admin.refunds.table' )
                    </div>
                </div>   
                <div class="tab-pane" id="requests" role="tabpanel" aria-expanded="false">
                    <div class="col-md-12">
                        @php
                            $users = App\UserValidId::where('is_valid', 2)->get();
                            $datatable_index = "2";
                            $title = "Refund requests";
                        @endphp
                        @include( 'admin.refunds.table' )
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
