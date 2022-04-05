<form method="POST" action="{{ route('rider_mgmt_add')}}">
    @csrf

<div class="form-group">
    <div class="row">
        <div class="col-md-8">
            <label>Email rider email address</label>
            <div class="form-group">
                <input type="email" class="form-control" name="rider_email" placeholder="Enter rider email" required>
            </div>
        </div>
    </div>
     <div class="row">
        <div class="col-md-8">
            <label>Rider password</label>
            <div class="form-group">
                <input type="text" class="form-control" name="rider_password" placeholder="Enter password" required>
            </div>
        </div>
    </div>
     <div class="row">
        <div class="col-md-8">
            <label>Rider name</label>
            <div class="form-group">
                <input type="text" class="form-control" name="rider_name" required placeholder="Enter rider name">
            </div>
        </div>
    </div>
     <div class="row">
        <div class="col-md-8">
            <label>Rider contact number</label>
            <div class="form-group">
                <input type="text" class="form-control" name="rider_contact" required placeholder="Enter rider contact number">
            </div>
        </div>
    </div>

     <div class="row">
        <div class="col-md-8">
            <label>Rider vehicle name</label>
            <div class="form-group">
                <input type="text" class="form-control" name="rider_vehicle" required placeholder="Enter vehicle name">
            </div>
        </div>
    </div>

     <div class="form-group row mb-0">
            <div class="col-md-8 text-left">
                <button type="submit" class="btn btn-success">
                    {{ __('Confirm') }}
                </button>
            </div>
        </div>

</div>
</form>