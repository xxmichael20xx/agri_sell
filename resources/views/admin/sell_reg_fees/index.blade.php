@extends('admin.front')
@section('content')
<div class="content">

    @if ( \Session::has( 'info' ) )
        <div class="form-group row">
            <div class="col-12">
                <div class="alert alert-info" role="alert">
                    <i class="fa fa-info-circle"></i> {{ \Session::get( 'info' ) }}
                </div>
            </div>
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Seller Registration</h4>
        </div>
    
        <div class="card-body">
            <div class="table-responsive">
                <table id="datatable" class="table" cellspacing="0" width="100%">
                    <thead class="text-primary">
                        <tr>
                            <th>
                                Name
                            </th>
                            <th>
                                Image Proof
                            </th>
                            <th>
                                Transaction Code
                            </th>
                            <th>
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ( $users as $user )
                            @php
                                $delta_time = time() - strtotime($user->created_at);
                                $hours = floor($delta_time / 3600);
                                $delta_time %= 3600;
                                $minutes = floor($delta_time / 60);
                                DB::table('seller_registration_fee')->where('id', $user->id)->update(['is_seen' => 'yes']);

                                $isNew = ( $hours < 1 && $minutes < 59 ) || $user->is_seen == 'no';
                                $newStyle = "";

                                if ( $isNew ) {
                                    $newStyle = 'style="background-color: #EEEEEE;"';
                                }
                            @endphp
                            <tr {{ $newStyle }}>
                                <td>
                                    @if (($hours < 1 && $minutes < 59) || $user->is_seen == 'no')
                                        <b> {{$user->shop->name ?? '' }}
                                        {{ $user->owner->name ?? '' }}</b>
                                    @else
                                        
                                    @endif                           
                                </td>
                                <td>
                                    <a  href="/storage/{{ $user->payment_proof }}">
                                        <img src="/storage/{{ $user->payment_proof }}" height="100">
                                    </a>
                                </td>
                                <td>
                                @if ( ( $hours < 1 && $minutes < 59 ) || $user->is_seen == 'no' )
                                        <b> {{ $user->trans_id ?? '' }} </b>
                                    @else
                                        {{ $user->trans_id ?? '' }}
                                    @endif    
                                </td>
                                {{-- <td class="text-right">
                                    @if ( isset( $user->owner->name ) )
                                        <a href="/admin/sell_reg_more_info/{{ $user->id }}"
                                            class="btn btn-sm btn-primary text-white m-1">More info</a>
                                            <a  class="btn btn-sm btn-primary text-white m-1" href="/admin/sell_reg_approved/{{ $user->id }}">
                                            Approve
                                        </a>
                                        @include('admin.sell_reg_fees.set_invalid_reason')
                                    @else
                                        <a href="/admin/sell_reg_delete/{{ $user->id }}" class="btn btn-sm btn-danger text-white m-1">Delete</a>
                                        <span class="btn btn-sm" style="background-color: #E45826">Deleted user</span>
                                    @endif
                                </td> --}}
                                <td>
                                    <a href="/admin/sell_reg_more_info/{{ $user->id }}"class="btn btn-sm btn-primary text-white m-1">More info</a>
                                    <button type="button" data-href="/admin/sell_reg_delete/{{ $user->id }}" class="btn btn-sm btn-danger text-white m-1 action">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('admin.custom_scripts')
<script>
    (function($) {
        $(document).ready(function() {
            $( document ).on( 'click', '.action', function() {
                const href = $( this ).data( 'href' )
                const action = $( this ).data( 'action' )
                const titleFragment = ( action == 'confirm' ) ? 'Confirmed' : 'Deleted'
                const buttonColor = ( action == 'confirm' ) ? '#51bcda' : '#dc3545'

                Swal.fire({
                    icon: 'warning',
                    title: 'Are you sure?',
                    text: `Seller Registration data will be ${titleFragment}!`,
                    showCancelButton: true,
                    showConfirmButton: true,
                    confirmButtonColor: buttonColor,
                    confirmButtonText: 'Confirm'
                }).then((event) => {
                    if ( event.value ) window.location.href = href
                })
            } )
        })
    })(jQuery)
</script>
@endsection