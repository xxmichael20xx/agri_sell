@extends('admin.front')
@section('content')

<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-navigation">
                <div class="nav-tabs-wrapper">
                    <ul id="tabs" class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#home" role="tab" aria-expanded="true">Verified</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#profile" role="tab" aria-expanded="false">Not verified</a>
                        </li>
                        
                         <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#uploaded" role="tab" aria-expanded="false">For verification</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div id="my-tab-content" class="tab-content">
                <div class="tab-pane active" id="home" role="tabpanel" aria-expanded="true">
                    <div class="col-md-12">
                        @php
                        $users = App\UserValidId::where('is_valid', 1)->get();
                        $datatable_index = "";
                        @endphp
                        @include('admin.valid_ids.index_subcat')
                    </div>
                </div>
                <div class="tab-pane" id="profile" role="tabpanel" aria-expanded="false">
                <div class="col-md-12">
                        @php
                        $users = App\UserValidId::where('is_valid', 0)->get();
                        $datatable_index = "2";
                        @endphp
                        @include('admin.valid_ids.index_subcat')
                    </div>
                </div>   
                 <div class="tab-pane" id="uploaded" role="tabpanel" aria-expanded="false">
                <div class="col-md-12">
                        @php
                        $users = App\UserValidId::where('is_valid', 2)->get();
                        $datatable_index = "3";
                        @endphp
                        @include('admin.valid_ids.index_subcat')
                    </div>
                </div>
            </div>
        </div>
</div>
@endsection
