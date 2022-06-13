@extends('layouts.front')
@section('content')
    <div class="shop-page-wrapper shop-page-padding ptb-20" style="margin-bottom: 350px;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3">
                    <div class="shop-sidebar mr-50">
                        <div class="sidebar-widget mb-50">
                            <h3 class="lead">Welcome back </h3>
                            <h4 class="display-6">{{ Auth::user()->name }}</h4>
                            <div class="sidebar-categories">
                                <ul>
                                {{--coins val --}}
                    @php
                        $total_ag_coins = 0;
                        $curr_ag_coins_insts = DB::table('coins_top_up')->where('user_id', Auth::id())->where('remarks', '1')->get();
                        foreach($curr_ag_coins_insts as $curr_ag_coins_obj){
                            $total_ag_coins += $curr_ag_coins_obj->value;    
                        }
                        $ag_coins_trans_insts = DB::table('coins_transaction')->where('user_id', Auth::id())->get();
                        foreach($ag_coins_trans_insts as $ag_coins_trans_obj){
                            $total_ag_coins -= $ag_coins_trans_obj->value;
                        }
                    @endphp
                    {{-- end of ag coins val --}}
                    <li><a href="user_coins_top_up">Agri Coins <span>{{$total_ag_coins}}
</span></a></li>

                                </ul>
                            </div>
                        </div>

                        <div class="sidebar-widget mb-45">
                            <h3 class="sidebar-title lead">Actions</h3>
                            <div class="sidebar-categories">
                                <ul>
                                    <li><a href="user_home">Account information </a></li>
                                    <li><a href="cart">My Basket</a></li>
                                    <li><a href="user_coins_top_up">Coins top up </a></li>
                                    <li><a href="user_orders">My orders </a></li>
                                    {{-- <li><a href="user_pre_orders">Pre sale orders </a></li> --}}
                                    <li><a href="notifications">My notifications </a></li>
                                    <li><a href="user_refund_requests">My refund requests </a></li>
                                    <li hidden><a href="otp_request_orders">Agricoins OTP requests</a></li>
                                </ul>
                            </div>
                        </div>


                    </div>
                </div>
                @yield('user_dash')
            </div>
        </div>
    </div>

@endsection
