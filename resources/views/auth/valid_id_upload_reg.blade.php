<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function checkvalidations() {
        if ( document.getElementById( "valid_id" ).value.length == 0 ) {
            Swal.fire(
                'Registration error',
                'Please insert valid id image',
                'error'
            )
        }
    }
</script>
<!-- Button trigger modal -->
<button type="button" class="btn btn-light" data-toggle="modal" data-target="#uploadValidIdModal">
   Upload Valid id
</button>

<!-- Modal -->
<div class="modal fade border-0" id="uploadValidIdModal" tabindex="-1" role="dialog" aria-labelledby="uploadValidIdModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered border-0" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="exampleModalLongTitle">Privacy Terms and Conditions</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body border-bottom-0">
                <div class="modal-text">
                    <p>This Policy applies to all personal data that you may provide to us and the personal data we hold about you. By providing us with your
                        personal data or by accessing, using or viewing the applicable website or any of its services, functions or contents (including
                        transmitting, caching or storing of any such personal data), you shall be deemed to have agreed to each and all the terms, conditions,
                        and notices in this Policy. If you do not agree, please cease use of the relevant website(s) and/or service(s) and DO NOT provide
                        any personal data to us.</p>
                </div>
                <div class="modal-text">
                    <label for="valid_id" class="form-group">Upload Valid id below</label>
                    <input 
                        id="valid_id" 
                        type="file"
                        class="form-control-file @error('valid_id') is-invalid @enderror"
                        name="valid_id"
                        value="{{ old('valid_id') }}" 
                        required
                        autocomplete="valid_id"
                    >

                    @error('valid_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

            </div>
            <div class="modal-footer border-top-0">
                <button type="button" class="btn btn-light" data-dismiss="modal">Upload</button>
            </div>
        </div>
    </div>
</div>
