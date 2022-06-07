@extends('admin.front')
@section('content')
<div class="content">
    @if ( \Session::has( 'info' ) )
        <div class="alert alert-info" role="alert">
            {{ __('Profile has been updated.') }}
        </div>
    @endif

    <form method="POST" action="{{ route('admin.profile.update') }}">
        @csrf
        <div class="form-group row">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Update Profile</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-6">
                                <label for="mobile" class="col-form-label text-md-right">{{ __('Mobile') }}</label>
                                <input 
                                    type="number"
                                    name="mobile"
                                    id="mobile" 
                                    onchange="" 
                                    class="form-control @error('mobile') is-invalid @enderror" 
                                    value="{{ $admin->mobile }}" 
                                    autocomplete="email"
                                    required>
                                <div class="invalid-feedback">
                                    Please input a valid phone number
                                </div>
                                @error('mobile')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="address" class=" col-form-label">{{ __('Address line(house #, street name/purok)') }}</label>
                                <input 
                                    id="address" 
                                    name="address"
                                    type="text"
                                    class="form-control @error('address') is-invalid @enderror" 
                                    value="{{ $admin->address }}" required autocomplete="email">
                                <div class="invalid-feedback">
                                    Please input an Address Line
                                </div>
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="b-day" class="col-form-label text-md-right">{{ __('Birthday') }}</label>
                                <input type="date" name="bday" id="b-day" class="form-control" value="{{ $admin->bday }}" required/>
                                @if( $errors->has( 'bday' ) )
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong class="text-danger">{{ $errors->first( 'bday' ) }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <input type="hidden" id="brgyval" name="barangay">
                            <input type="hidden" id="townval" name="town">
                            <input type="hidden" id="provval" name="province">
                        </div>

                        <div class="form-group row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col col-lg-4">
                                        <label>Province</label>
                                        <select id="province" class="form-control" disabled="disabled" onload="setProvince()">
                                            <option>Select province</option>
                                        </select>
                                    </div>
                                    <div class="col col-lg-4">
                                        <label>Municipality/City</label>
                                        <select id="municipality" class="form-control" onchange="setTown()">
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

                        <div class="form-group row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
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
            
            const brgy = `{{ $admin->barangay }}`
            const town = `{{ $admin->town }}`
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