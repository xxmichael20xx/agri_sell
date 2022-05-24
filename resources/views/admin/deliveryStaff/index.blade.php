@extends('admin.front')
@section('content')
<div class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header d-flex justify-content-between">
					<h4 class="card-title">Rider management</h4>
					<a  class="btn btn-success text-white text-right m-3" href="/admin/rider_registration">Add new</a>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table id="datatable" class="table" cellspacing="0" width="100%">
							<thead class="text-primary">
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
								@foreach ( $deliver_Staffs as $delivery_staff )
									<tr>
										<td>
											{{ $delivery_staff->user->name ?? 'not available' }}
										</td>
										<td>
											{{ $delivery_staff->user->mobile ?? 'not available' }}
										</td>
										<td>
											{{ $delivery_staff->user->email ?? 'not available' }}
										</td>
										<td>
											{{ $delivery_staff->vehicle_used ?? 'not available' }}
										</td>
										<td>
											{{ $delivery_staff->rider_id ?? 'not available' }}
										</td>
										<td>
											<button type="button" class="btn btn-danger btn-rider-delete" data-href="/admin/remove_rider/{{ $delivery_staff->user_id }}">Delete</button>
											<button type="button" class="btn btn-primary btn-rider-password" data-id="{{ $delivery_staff->id }}">Show Password</button>
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

@section('admin.custom_scripts')
<script>
	(function($) {
		$(document).ready(function() {
			$( document ).on( 'click', '.btn-rider-password', function() {
				const id = $( this ).data( 'id' )
				Swal.fire({
					icon: 'info',
					title: 'Provide your password for verification',
					html: `<input type="password" id="user-password" class="swal2-input" autocomplete="off">`,
					showCancelButton: true,
					confirmButtonText: 'Verify',
					showLoaderOnConfirm: true,
					preConfirm: () => {
						const password = Swal.getPopup().querySelector( '#user-password' ).value

						return fetch( `/api/admin/rider/verify`, {
							method: 'POST',
							headers: {
								'Content-Type': 'application/json',
							},
							body: JSON.stringify({ password: password, id: id }) 
						}).then( response => {
							if ( ! response.ok ) {
								throw new Error( response.statusText )
							}
							return response.json()
						}).catch( error => {
							Swal.showValidationMessage(
								`Request failed: ${error}`
							)
						} )
					},
					allowOutsideClick: () => ! Swal.isLoading()
					}).then( ( result ) => {
						if ( result.value ) {
							if ( result?.value?.success ) {
								Swal.fire({
									icon: 'info',
									title: 'Verification Complete',
									text: `Password is: ${result.value.data}`
								})
							} else {
								Swal.fire({
									icon: 'info',
									title: 'Verification Failed',
									text: `Incorrect password`
								})
							}
						}
					} )
			} )

			$( document ).on( 'click', '.btn-rider-delete', function() {
				const href = $( this ).data( 'href' )
				Swal.fire({
					icon: 'warning',
					title: 'Are you sure?',
					text: `Rider data will be deleted and can't be reverted!`,
					showCancelButton: true,
					showConfirmButton: true,
					confirmButtonColor: '#dc3545',
					confirmButtonText: 'Confirm'
				}).then( ( event ) => {
					if ( event.value ) window.location.href = href
				} )
			} )
		})
	})(jQuery)
</script>
@endsection