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

        <div class="form-group row mb-0">
            <div class="col text-left">
                <button type="submit" class="btn btn-primary">Create Rider</button>
            </div>
        </div>
    </div>
</form>