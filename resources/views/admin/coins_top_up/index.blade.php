@extends('admin.front')
@section('content')
<div class="content">
<div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-navigation">
                <div class="nav-tabs-wrapper">
                    <ul id="tabs" class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#verified" role="tab"
                                aria-expanded="true">Valid</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#unverified" role="tab"
                                aria-expanded="false">Invalid</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div id="my-tab-content" class="tab-content">
                <div class="tab-pane active" id="verified" role="tabpanel" aria-expanded="true">
                    <div class="col-md-12">
                        @php
                        $users = App\coinsTopUpModel::where('remarks', 1)->get();
                        $datatable_index = "";
                        @endphp
                        @include('admin.coins_top_up.index_subcat')
                    </div>
                </div>
                <div class="tab-pane" id="unverified" role="tabpanel" aria-expanded="false">
                <div class="col-md-12">
                        @php
                        $users = App\coinsTopUpModel::where('remarks', 0)->get();
                        $datatable_index = "2";
                        @endphp
                        @include('admin.coins_top_up.index_subcat')
                    </div>
                </div>
                <div class="tab-pane" id="messages" role="tabpanel" aria-expanded="false">
                    <p>Here are your messages.</p>
                </div>
            </div>
        </div>
</div>
@endsection
