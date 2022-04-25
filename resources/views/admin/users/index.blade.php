@extends('admin.front')
@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-navigation">
                <div class="nav-tabs-wrapper">
                    <ul id="tabs" class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link font-weight-bold active" data-toggle="tab" href="#reg_user" role="tab" aria-expanded="true">Regular user</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link font-weight-bold" data-toggle="tab" href="#admin" role="tab" aria-expanded="false">Admin</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link font-weight-bold" data-toggle="tab" href="#seller" role="tab" aria-expanded="false">Seller</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link font-weight-bold" data-toggle="tab" href="#rider" role="tab" aria-expanded="false">Rider</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link font-weight-bold" data-toggle="tab" href="#employee" role="tab" aria-expanded="false">Coins top up employee</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div id="my-tab-content" class="tab-content">
                <div class="tab-pane active" id="reg_user" role="tabpanel" aria-expanded="true">
                    <div class="col-md-12">
                    @php
                        $users = App\User::where('role_id', '2')->get();      
                        $datatable_index = "";
                        $title = "Regular user";
                    @endphp
                    @include('admin.users.index_subcat')
                    </div>
                </div>
                <div class="tab-pane" id="admin" role="tabpanel" aria-expanded="false">
                    <div class="col-md-12">
                        @php
                            $users = App\User::where('role_id', '1')->get();        
                            $datatable_index = "2";
                            $title = "Admin";
                        @endphp
                        @include('admin.users.index_subcat')
                    </div>
                </div>
                <div class="tab-pane" id="rider" role="tabpanel" aria-expanded="false">
                    <div class="col-md-12">
                        @php
                            $users = App\User::where('role_id', '5')->get();   
                            $datatable_index = "3";
                            $title = "Seller";
                        @endphp
                        @include('admin.users.index_subcat')
                    </div>
                </div>
                <div class="tab-pane" id="seller" role="tabpanel" aria-expanded="false">
                    <div class="col-md-12">
                        @php
                            $users = App\User::where('role_id', '3')->get();     
                            $datatable_index = "4";
                            $title = "Rider";
                        @endphp
                        @include('admin.users.index_subcat')
                    </div>
                </div>

                <div class="tab-pane" id="employee" role="tabpanel" aria-expanded="false">
                    <div class="col-md-12">
                        @php
                            $users = App\User::where('role_id', '6')->get();     
                            $datatable_index = "6";
                            $title = "Coins top up employee";
                        @endphp
                        @include('admin.users.index_subcat')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
