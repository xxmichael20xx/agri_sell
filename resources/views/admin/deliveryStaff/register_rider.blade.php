@extends('admin.front')
@section('content')
<div class="content">
	<div class="row">
		<div class="col-md-6">
			<div class="card">
				<div class="card-header">Register a rider</div>
				<div class="card-body"> 
					@include('admin.deliveryStaff.riderRegistrationForm')
				</div>
			</div>
		</div>
	</div>
</div>
@endsection