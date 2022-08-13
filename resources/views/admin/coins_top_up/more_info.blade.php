@extends('coinsTopUpEmpPanel.front')
@section('content')
<div class="content">
    <a href="/coins_dashboard" class="btn btn-outline-dark btn-round m-1">Go back</a>
    <div class="row">
        <div class="col-md-4">
            <div class="card mt-2">
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
                    <span class="text-muted"><span class="dark-highlight">Name:</span> {{$user_obj->name}}</span>
                    <br>
                    <span class="text-muted"><span class="dark-highlight">Address:</span> {{$user_obj->address}} {{$user_obj->barangay}} {{$user_obj->town}} {{$user_obj->province}}</span>
                    <br>
                    <span class="text-muted"><span class="dark-highlight">Amount:</span> {{$user->value}}</span>
                    <br>
                    <span class="text-muted"><span class="dark-highlight">Transaction id:</span> {{$user->trans_id}}</span>
                    @php
                        $trans_code_existence = App\TransactionCode::trans_code_duplicate_check_display($user->trans_id);
                    @endphp
                    <!-- <span class="text-muted">Is transaction id used: {{$trans_code_existence}}</span> -->
                    <br>
                    @if ($user->remarks == '0')
                        <span class="text-muted"><span class="dark-highlight">Verication status:</span> Not Approved </span>
                    @elseif ($user->remarks == '1')
                        <span class="text-muted"><span class="dark-highlight">Verication status:</span> Approved </span>
                        <br>
                        <span class="text-muted"><span class="dark-highlight">Date approved:</span> {{ AppHelpers::humanDate( $user->updated_at, true ) }}</span>
                    @elseif ($user->remarks == '2')
                        <span class="text-muted"><span class="dark-highlight">Verication status:</span> For verification</span>
                    @endif

                    <br>

                    @if($user->invalid_reason != '')
                        <span class="text-muted"><span class="dark-highlight">Invalid status:</span> {{$user->invalid_reason}}</span>
                    @endif

                    <br>

                    @if ( $user->remarks == '0' )
                        <button class="btn btn-danger btn-round m-1 btn-action" data-href="/coinsEmp/delete_coins_top_up/{{ $user->id }}">Delete request</button>
                    @endif
                    
                    @if ( $user->remarks == '2')
                        <a href="/unset_as_verified_coins_top_up/{{ $user->id }}" class="btn btn-danger btn-round m-1" data-toggle="modal" data-target="#notVerifyReason">Reject</a>
                        <div class="modal fade" id="notVerifyReason" tabindex="-1" role="dialog" aria-labelledby="notVerifyReasonLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="notVerifyReasonLabel">Not approved coins top up proof</h5>
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
                                            {{-- <option value="not valid">Not Valid</option> --}}
                                            {{-- <option value="wrong information">Wrong Information</option> --}}
                                            <option value="wrong details">Wrong details</option>
                                            <option value="incorrect reference number">Incorrect reference number</option>
                                            <option value="incorrect amount">Incorrect amount</option>
                                        </select>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" form="coins_top_up" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                
                        <a href="/set_as_verified_coins_top_up/{{$user->id}}" class="btn btn-success btn-round m-1">Confirm</a>
                        {{-- @include('admin.coins_top_up.edit_coins_top_up_amount_modal') --}}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section( 'coins.custom_scripts' )
    <script>
        (function($) {
            $(document).ready(function() {
                $( document ).on( 'click', '.btn-action', function() {
                    const href = $( this ).data( 'href' )
                    
                    Swal.fire({
                        icon: 'info',
                        title: 'Are you sure?',
                        text: `Request will be deleted! There's no going back!`,
                        showCancelButton: true,
                        showConfirmButton: true,
                        confirmButtonColor: '#dc3545',
                        confirmButtonText: 'Confirm'
                    }).then( (event) => {
                        if ( event.value ) {
                            window.location.href = href
                        }
                    } )
                } )
            })
        })(jQuery)
    </script>
@endsection
