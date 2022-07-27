<form method="POST" action="{{ route('rider_mgmt_add')}}">
    @csrf
    <div class="form-group">
        <div class="row">
            <div class="col">
                <label>Email rider email address</label>
                <div class="form-group">
                    <input type="email" class="form-control" name="rider_email" value="{{ old('rider_email') }}">
                    @if ( $errors->has( 'rider_email' ) )
                        <span class="text-danger">{{ $errors->first( 'rider_email' ) }}</span>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <label>Rider password</label>
                <div class="form-group">
                    <input type="password" class="form-control" name="rider_password" value="{{ old('rider_password') }}">
                    @if ( $errors->has( 'rider_password' ) )
                        <span class="text-danger">{{ $errors->first( 'rider_password' ) }}</span>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <label>Rider name</label>
                <div class="form-group">
                    <input type="text" class="form-control" name="rider_name" value="{{ old('rider_name') }}">
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
                    <input type="text" class="form-control" name="rider_contact" value="{{ old('rider_contact') }}">
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
                    <input type="text" class="form-control" name="rider_vehicle" value="{{ old('rider_vehicle') }}">
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
                    value="{{ old( 'rider_address' ) }}"
                    autocomplete="email">
                @if ( $errors->has( 'rider_address' ) )
                    <span class="text-danger">{{ $errors->first( 'rider_address' ) }}</span>
                @endif
            </div>
            <div class="col-6">
                <label for="b-day" class="col-form-label text-md-right">{{ __('Birthday') }}</label>
                <input type="date" name="rider_bday" id="b-day" class="form-control" value="{{ old( 'rider_bday' ) }}" />
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
                <button type="submit" class="btn btn-primary">Create Rider</button>
            </div>
        </div>
    </div>
</form>