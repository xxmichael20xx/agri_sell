@extends('userdash.user_dash_front')
@section('user_dash')
<div class="col-lg-9">
    <div class="row">
        <link href="assets/css/user_badge.css" rel="stylesheet">

        <!------ Include the above in your HEAD tag ---------->

        <div class="container">
            <div class="row">
                <div class="profile-header-container">   
                    <div class="profile-header-img-{{Auth::user()->role->name}}">
                        <img class="img-circle-{{Auth::user()->role->name}}" src="{{env('APP_URL')}}/storage/{{Auth::user()->avatar}}" />

                        <div class="rank-label-container">
                            <span class="label label-{{Auth::user()->role->name}} rank-label text-white">{{Auth::user()->role->display_name}} </span>
                        </div>
                        <div class="mt-2">
                            <br> {{Auth::user()->name}}
                            <br>  Address: {{ Auth::user()->address . ' ' . Auth::user()->barangay . ' ' . Auth::user()->town . ' ' . Auth::user()->province ?? 'Pangasinan' }}
                            <br>
                            Birthday: {{ Auth::user()->bday }}
                            <br>
                            Mobile number: {{ Auth::user()->mobile }}
                            <br>
                            <!-- Button trigger modal -->
                            <button hidden type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal">
                              Edit profile
                            </button>
                          <!-- Modal -->
                          <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel">Edit your profile</h5>
                                </div>
                                <div class="container">
                                   <form method="POST" action="/submitedituser" enctype="multipart/form-data">
                                      @csrf        
                                       <div class="form-group">
                                            <label for="exampleInputEmail1">Full name</label>
                                            <input type="text" class="form-control" name="full_name" placeholder="" value="{{Auth::user()->name}}">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Mobile</label>
                                            <input type="text" class="form-control" name="address" placeholder="" value="{{Auth::user()->mobile}}">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Enter new password</label>
                                            <input type="text" class="form-control" name="password" placeholder="" value="{{Auth::user()->password}}">
                                        </div>

                                      @include('auth.register_address_dropdown');
                                  </form>
                              </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div>
</div>
</div>
</div>
@endsection
