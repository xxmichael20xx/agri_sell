@extends('admin.front')
@section('content')
<div class="content">
    <a href="/admin/coins_top_up" class="btn btn-outline-dark btn-round m-1">Go back</a>
    <div class="row">
        <div class="col-md-8">
            <div class="card card-plain">
                <div class="card-header">
                    <h5 class="card-title">Coins top up proof</h5>
                </div>
                <div class="card-body">
                    <img src="{{asset('storage/'.$user->image_proof)}}">
                    <br>
                    <div class="mt-5"></div>
                    @php
                    $user_obj = DB::table('users')->where('id', $user->user_id)->first();
                    @endphp
                    <span class="text-muted ">Name: {{$user_obj->name}}</span>
                    <br>
                    <span class="text-muted">Address: {{$user_obj->address}} {{$user_obj->barangay}} {{$user_obj->town}}
                        {{$user_obj->province}}</span>
                    <br>
                    <span class="text-muted">Amount: {{$user->value}}</span>
                    <br>
                    <span class="text-muted">Transaction id: {{$user->trans_id}}</span>
                    <br>
                    @php
                    $trans_code_existence = App\TransactionCode::trans_code_duplicate_check_display($user->trans_id);
                    @endphp
                    <!-- <span class="text-muted">Is transaction id used: {{$trans_code_existence}}</span> -->
                    <br>
                    <span class="text-muted">Verication status: </span>
                    <br>
                    @if ($user->remarks == '0')
                    <span class="text-muted">Invalid id status: {{$user->invalid_reason}}</span>
                    @endif
                    <br>
                    @if ($user->remarks == '1')
                    <span class="text-muted">Verified</span>
                    <br>
                    <a href="/unset_as_verified_coins_top_up/{{$user->id}}" class="btn btn-danger btn-round m-1"
                        data-toggle="modal" data-target="#notVerifyReason">Mark as not verified</a>

                    <div class="modal fade" id="notVerifyReason" tabindex="-1" role="dialog"
                        aria-labelledby="notVerifyReasonLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="notVerifyReasonLabel">Not valid coins top up proof</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('coins_invalid_init')}}" id="coins_top_up" method="POST">
                                    @csrf
                                    @method('POST')
                                </form>
                                <div class="modal-body">
                                    <input type="hidden" form="coins_top_up" name="coins_top_uid" value="{{$user->id}}">
                                    <select class="selectpicker" form="coins_top_up" name="coins_top_up_invalid"
                                        data-style="btn btn-primary btn-round" title="Single Select" tabindex="-98">
                                        <option value="incorrect_details">Incorrect details</option>
                                        <option value="wrong_value">Wrong value</option>
                                        <option value="reused_receipt">Reused receipt</option>
                                    </select>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" form="coins_top_up" class="btn btn-primary">Save
                                        changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @elseif ($user->remarks == '0')
                    <span class="text-muted">Not Verified </span>
                    <br>
                    <a href="/set_as_verified_coins_top_up/{{$user->id}}" class="btn btn-success btn-round m-1">Mark as verfied</a>
                    @endif

                    @include('coinsTopUpEmpPanel.coins_top_up.edit_coins_top_up_amount_modal')

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
