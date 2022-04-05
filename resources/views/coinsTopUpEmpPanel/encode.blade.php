@extends('coinsTopUpEmpPanel.front')
@section('content')
<div class="content">
    <div class="row">
        <div class="col col-12 col-lg-9">
            <div class="card">
                <form method="POST" autocomplete="off" id="encodeCoins" enctype="multipart/form-data"
                    action="{{ route('encode_coins_top_up') }}">
                    @csrf
                    @method('POST')
                </form>
                <div class="card-header">
                    <h4>Encode new coins top up</h4>
                </div>
                <div class="card-body">
                <input type="hidden" form="encodeCoins" name="emp_user_id" value="{{Auth::user()->id}}" placeholder="">
                <div class="row">
                        <label class="col-md-3 col-form-label">Transaction type</label>
                        <div class="col-md-9">
                        <div class="form-group">
                        <select class="selectpicker w-100" data-style="btn btn-primary btn-round" form="encodeCoins" title="Select coins category" name="coins_top_up_cat" required>
                        <option value="gcash" selected>Gcash</option>
                        <option value="paymaya">Paymaya</option>
                        <option value="rem_centers">Remittance centers</option>
                        </select>
                        </div>                       
                        </div>
                    </div>  
                    <div class="row">
                        <label class="col-md-8 col-form-label">Reference number/Transaction code</label>
                        <div class="col-md-4">
                        <div class="form-group">
                                <input type="text" class="form-control" form="encodeCoins" name="reference_number"
                                    placeholder="">
                        </div>                       
                        </div>
                    </div>

                    <div class="row">
                        <label class="col-md-8 col-form-label">Amount</label>
                        <div class="col-md-4">
                        <div class="form-group">
                                <input type="text" class="form-control" form="encodeCoins" name="amount" placeholder="">
                        </div>                       
                        </div>
                    </div>
                    
                </div>
                <div class="card-footer">
                    <button class="btn btn-warning btn-round" form="encodeCoins">Save</button>
                    <a href="/coins_dashboard" class="btn btn-dark btn-round text-light">Cancel</a>
                </div>
            </div>
        </div>
    </div>
</div>
@include('coinsTopUpEmpPanel.auto_complete_name_list')
@endsection
