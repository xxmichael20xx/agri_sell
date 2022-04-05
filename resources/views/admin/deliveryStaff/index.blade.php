@extends('admin.front')
@section('content')
<div class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Rider management</h4>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<div class="toolbar">
							 <div class="text-right">
                    <a  class="btn btn-success text-white text-right m-3" href="/admin/rider_registration">Add
                        new</a>
                </div>
						</div>
						<table id="datatable" class="table " cellspacing="0" width="100%">
							<thead class=" text-primary">
								<tr>
									<th>
										Rider name
									</th>
									<th>
										Rider contact number
									</th>
									<th>
										Rider email
									</th>				
									<th>
										Rider password
									</th>
									<th>
										Rider vehicle
									</th>
									<th>
										Rider reference ID
									</th>
									<th>
										Actions
									</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($deliver_Staffs as $delivery_staff)
								<tr>
									<td>
										{{$delivery_staff->user->name ?? 'not available'}}
									</td>
									<td>
										{{$delivery_staff->user->mobile ?? 'not available'}}
									</td>
									<td>
										{{$delivery_staff->user->email ?? 'not available'}}
									</td>
									<td>
										{{$delivery_staff->password ?? 'not available'}}
									</td>
									<td>
										{{$delivery_staff->vehicle_used ?? 'not available'}}
									</td>
									<td>
										{{$delivery_staff->rider_id ?? 'not available'}}
									</td>
									<td>
										<a class="btn btn-danger" href="/admin/remove_rider/{{$delivery_staff->user_id}}">Remove</a>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	@endsection