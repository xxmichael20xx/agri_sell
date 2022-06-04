@extends('admin.front')
@section('content')
<div class="content">
    @if ( \Session::has( 'info' ) )
        <div class="alert alert-info" role="alert">
            <i class="fa fa-info-circle"></i> {{ \Session::get( 'info' ) }}
        </div>
    @endif

    @if ( \Session::has( 'success' ) )
        <div class="alert alert-success" role="alert">
            <i class="fa fa-info-circle"></i> {{ \Session::get( 'success' ) }}
        </div>
    @endif
    <a href="/admin/rider_management" class="btn btn-outline-dark btn-round mb-4">Go Back</a>

	<div class="row">
        <div class="col-md-6">
			<div class="card">
				<div class="card-header">
                    <h5 class="card-title">Update Rider</h5>
                </div>
				<div class="card-body"> 
                    <form method="POST" action="{{ route( 'rider_mgmt_update' )}}">
                        @csrf
                        <input type="hidden" name="id" id="id" value="{{ $rider->user_id }}">

                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label>Rider name</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="rider_name" value="{{ $rider->user->name }}">
                                        @if ( $errors->has( 'rider_name' ) )
                                            <span class="text-danger">{{ $errors->first( 'rider_name' ) }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label>Rider contact number</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="rider_contact" value="{{ $rider->user->mobile }}">
                                        @if ( $errors->has( 'rider_contact' ) )
                                            <span class="text-danger">{{ $errors->first( 'rider_contact' ) }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                    
                            <div class="row">
                                <div class="col">
                                    <label>Rider vehicle name</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="rider_vehicle" value="{{ $rider->vehicle_used }}">
                                        @if ( $errors->has( 'rider_vehicle' ) )
                                            <span class="text-danger">{{ $errors->first( 'rider_vehicle' ) }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                    
                            <div class="form-group row mb-0">
                                <div class="col text-left">
                                    <button type="submit" class="btn btn-primary">Update Rider</button>
                                </div>
                            </div>
                        </div>
                    </form>
				</div>
			</div>
		</div>
    </div>
</div>
@endsection