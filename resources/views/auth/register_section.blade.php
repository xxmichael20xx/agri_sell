<script>

        function setName() {
            var last_name = document.getElementById('last_name').value;
            var first_name = document.getElementById('first_name').value;
            var middle_initial = document.getElementById('middle_initial').value;
            document.getElementById('name').value = first_name + " " + middle_initial + " " + last_name;
        }

    </script>
<!-- Large modal -->


<div class="card border-0 shadow-lg">
    <div class="card-header border-0 text-white bg-success p-4">{{ __('Register') }}
</div>
 
    <div class="card-body">
        <div class="form-group row" hidden>
            <label for="name"
                   class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

            <div class="col-md-6">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                       name="name" value="{{ old('name') }}" required autocomplete="name"
                       autofocus>

                @error('name')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-5">
                    <label for="first_name"
                        class=" col-form-label text-md-right">{{ __('First Name') }}</label>
                        <div class="input-group has-validation">
                    <input id="first_name" type="text" class="form-control" onchange="setName()" name="first_name" value="{{ old( 'first_name' ) }}" required>

                    <div class="invalid-feedback">
                    Please input your first name
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                
                <label for="last_name"
                       class=" col-form-label text-md-right">{{ __('Last Name') }}</label>
                <div class="input-group has-validation">
                <input id="last_name" onchange="" type="text" onchange="setName()" class="form-control" name="last_name" value="{{ old( 'last_name' ) }}" required>
                <div class="invalid-feedback">
                    Please enter your last name
                </div>
                </div>

            </div>
            <div class="col-md-3">
                <label for="first_name"
                       class=" col-form-label text-md-right">{{ __('Middle Initial') }}</label>
                <input id="middle_initial" type="text" class="form-control" onchange="setName()" name="middle_initial" value="{{ old( 'middle_initial' ) }}" required>
                <div class="invalid-feedback">
                    Please enter your middle initial
                </div>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-6">
                <label for="email"
                       class="col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                <div class="input-group has-validation">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                       name="email" value="{{ old('email') }}" required
                       autocomplete="email">
                       <div class="invalid-feedback">
                    Please input a valid email
                </div>
                </div>
                @error('email')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="mobile"
                       class="col-form-label text-md-right">{{ __('Mobile') }}</label>
                <div class="input-group has-validation">
                <input id="mobile" onchange="" type="number"
                       class="form-control @error('mobile') is-invalid @enderror" name="mobile"
                       value="{{ old('mobile') }}" required autocomplete="email">
                       <div class="invalid-feedback">
                            Please input a valid phone number
                       </div>
                </div>
                @error('mobile')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row" >
            <div class="col-6">
                <label for="password">{{ __('Password') }}</label>
                <div class="input-group has-validation">
                    <input id="password" type="password"
                        class="form-control @error('password') is-invalid @enderror" name="password"
                        required autocomplete="new-password">
                        <div class="invalid-feedback">
                            Please input a password
                       </div>
                </div>
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                    @enderror
            </div>

            <div class="col-6">
            <label for="password-confirm">{{ __('Confirm Password') }}</label>
                <input id="password-confirm" type="password" class="form-control"
                       name="password_confirmation" required autocomplete="new-password">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6">
                <label for="address"
                       class=" col-form-label">{{ __('Address line(house #, street name/purok)') }}</label>
                       <div class="input-group has-validation">

                <input id="address" type="text"
                       class="form-control @error('address') is-invalid @enderror" name="address"
                       value="{{ old('address') }}" required autocomplete="email">
                       <div class="invalid-feedback">
                            Please input an Address Line
                       </div>
                    </div>
                @error('address')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="b-day" class="col-form-label text-md-right">{{ __('Birthday') }}</label>
                <input type="date" name="bday" id="bday" class="form-control" value="{{ old( 'bday' ) }}" max="{{ date('Y-m-d') }}" required/>
                <div class="invalid-feedback">
                    Please select birth date
                </div>
            </div>
            <input type="hidden" id="brgyval" name="barangay" value="Amamperez">
            <input type="hidden" id="townval" name="town" value="Villasis">
            <input type="hidden" id="provval" name="province" value="Pangasinan">
        </div>
        
        <div class="form-group row">            
        </div>
        <div class="form-group row">
        <div class="col-12">
    @include('auth.register_address_dropdown')
</div>
    </div>
        <div class="form-group row mb-0">
            <div class="col-md-6 text-left">
                @include('auth.valid_id_upload_reg')
            </div>
            <div class="col-md-6 text-right">
                <button type="submit" onclick="checkvalidations()" class="btn btn-success">{{ __('Register') }}</button>
                {{-- <button type="submit" class="btn btn-success">{{ __('Register') }}</button> --}}
            </div>
        </div>
    </div>
</div>

<script>
    $( "#register_modal_trigger" ).trigger( "click" );
</script>
