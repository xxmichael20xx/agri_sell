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

                            <div class="form-group row">
                                <div class="col-6">
                                    <label for="address" class=" col-form-label">{{ __('Address line(house #, street name/purok)') }}</label>
                                    <input 
                                        id="address" 
                                        name="rider_address"
                                        type="text"
                                        class="form-control" 
                                        value="{{ $rider->user->address }}"
                                        autocomplete="email">
                                    @if ( $errors->has( 'rider_address' ) )
                                        <span class="text-danger">{{ $errors->first( 'rider_address' ) }}</span>
                                    @endif
                                </div>
                                <div class="col-6">
                                    <label for="b-day" class="col-form-label text-md-right">{{ __('Birthday') }}</label>
                                    <input type="date" name="rider_bday" id="b-day" class="form-control" value="{{ $rider->user->bday }}" />
                                    @if( $errors->has( 'rider_bday' ) )
                                        <span class="text-danger">{{ $errors->first( 'rider_bday' ) }}</span>
                                    @endif
                                </div>
                                <input type="hidden" id="brgyval" name="rider_barangay">
                                <input type="hidden" id="townval" name="rider_town">
                                <input type="hidden" id="provval" name="rider_province">
                            </div>
                        
                            <div class="form-group row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col col-lg-4">
                                            <label>Province</label>
                                            <select id="province" class="form-control" disabled="disabled"  onload="setProvince()">
                                                <option>Select province</option>
                                            </select>
                                        </div>
                                        <div class="col col-lg-4">
                                            <label>Municipality/City</label>
                                            <select id="municipality" class="form-control"  onchange="setTown()">
                                                <option value="">Select municipality</option>
                                            </select>
                                        </div>
                                        <div class="col col-lg-4">
                                            <label>Barangay</label>
                                            <select id="barangay" class="form-control input-lg"  onchange="setBarangay()">
                                                <option value="">Select barangay</option>
                                            </select>
                                        </div>
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
            $("#provval").val( val )
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
                                html_code += '<option value="' + value.id + '">' + value.name +
                                    '</option>';
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
            
            const brgy = `{{ $rider->user->barangay }}`
            const town = `{{ $rider->user->town }}`
            setTimeout( () => {
                $( '#province' ).val( 1 ).change()

                $.getJSON( '/province_municipality_barangay.json', function ( res ) {
                    const _town = res.find( x => {
                        if ( x.name.trim() == town ) return x
                    } )

                    const _brgy = res.find( x => {
                        if ( _town.id == x.parent_id && x.name.trim() == brgy ) return x
                    } )

                    $( '#municipality' ).val( _town.id ).change()
                    setTimeout( () => {
                        $( '#barangay' ).val( _brgy.id ).change()
                    }, 1500 )
                } )
            }, 1500 )
        });

    </script>
@endsection