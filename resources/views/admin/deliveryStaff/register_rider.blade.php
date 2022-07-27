@extends('admin.front')
@section('content')
<div class="content">
	<div class="row">
		<div class="col-md-5">
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
@section('admin.custom_scripts')
    <script>
        function setTown() {
            const val = $( "#municipality" ).val()
            $("#townval").val( val )
        }

        function setBarangay() {
            const val = $( "#barangay" ).val()
            $("#brgyval").val( val )
        }

        function setProvince() {
            const val = $( "#province" ).val()
            $("#provval").val( 1 )
        }

        $(document).ready(function () {
            load_json_data('province');

            function load_json_data(id, parent_id) {
                var html_code = '';
                $.getJSON('/province_municipality_barangay.json', function (data) {
                    html_code += '<option value="">Select ' + id + '</option>';
                    $.each(data, function (key, value) {
                        if (id == 'province') {
                            if (value.parent_id == '0') {
                                html_code += '<option value="' + value.id + '" selected>' + value.name +
                                    '</option>';
									
								$("#provval").val( 1 )
                            }
                        } else {
                            if (value.parent_id == parent_id) {
                                html_code += '<option value="' + value.id + '">' + value.name +
                                    '</option>';
                            }
                        }
                    });
                    $('#' + id).html(html_code);
                });
            }

            $( document ).ready(function() {
                var province_id = $(this).val();
                var province_id = '1';

                if (province_id != '') {
                    load_json_data('municipality', province_id);
                } else {
                    $('#municipality').html('<option value="">Select municipality</option>');
                    $('#barangay').html('<option value="">Select barangay</option>');
                }
            });

            $(document).on('load', '#province', function () {
                var province_id = $(this).val();
                var province_id = '1';
                if (province_id != '') {
                    load_json_data('municipality', province_id);
                } else {
                    $('#municipality').html('<option value="">Select municipality</option>');
                    $('#barangay').html('<option value="">Select barangay</option>');
                }
            });

            $(document).on('change', '#municipality', function () {
                var municipality_id = $(this).val();

                if (municipality_id != '') {
                    load_json_data('barangay', municipality_id);
                } else {
                    $('#barangay').html('<option value="">Select barangay</option>');
                }
            });
        });

    </script>
@endsection