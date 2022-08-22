@extends('userdash.user_dash_front')

@section('user_dash')
<style>
    input#exampleFormControlFile1 {
    background: none;
    border: 0;
}
</style>
    <div class="col-lg-9">
        <h1 class="lead display-6">Coins top up</h1>
        <div class="row">
        <div class="row justify-content-center">
    </div>
    <div class="row justify-content-center  pt-5">
        <div class="col col-lg-4  col-md-10 col-12">
            <div class="card w-100 shadow-sm border-0 p-2">
                <img class="card-img-top"
                    src="https://www.bworldonline.com/wp-content/uploads/2021/07/GCash-logo-640x427.jpg"
                    alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Gcash transfer</h5>
                    <p class="card-text">Gcash number : 09068370960</p>
                    <a href="https://help.gcash.com/hc/en-us/articles/360017722873-How-do-I-Send-Money-to-another-GCash-account-" class="btn btn-info text-white w-100">More info</a>
                </div>
            </div>
        </div>
        <div class="col col-lg-4  col-md-10 col-12">
            <div class="card w-100 shadow-sm border-0 p-2">
                <img class="card-img-top"
                    src="https://sa.kapamilya.com/absnews/abscbnnews/media/2019/business/07/08/paymaya-logo.jpg"
                    alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Paymaya transfer</h5>
                    <p class="card-text">Paymaya number : 09068370960</p>
                    <a href="https://www.paymaya.com/quick-guide/send-money" class="btn btn-info text-white w-100">More info</a>
                </div>
            </div>
        </div>
        <div class="col col-lg-4 col-md-10 col-12">
            <div class="card w-100 shadow-sm border-0 p-2">
                <img class="card-img-top"
                    src="/assets/img/money_remittance.png"
                    alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Money remittance centers</h5>
                    <p class="card-text">Address: Urdaneta Pangasinan<br>Recepient number : 09053328625<br>Receiver name: Heide Tique</p>
                    <a href="https://www.palawanpawnshop.com/pera-padala" class="btn btn-info text-white w-100">More info</a>
                </div>
            </div>
        </div>
    </div>
    <form method="POST" action="user_coins_top_up_conf" id="coins_top_up" enctype="multipart/form-data">
        @csrf
        <div class="row justify-content-center mt-5">

            <div class="col col-lg-12 col-md-12">
            <div class="form-group">
            <label> It may take up to 24 hours for the money to be credited in your account</label><br>
                    <label>Amount in Pesos:</label>
                    <input type="number" class="form-control-sm mb-3" name="coins_top_up_amount">
                    <label>Transaction type</label>
                    <select name="coins_top_up_type">
                        <option value="gcash">Gcash</option>
                        <option value="paymaya">Paymaya</option>
                        <option value="rem_centers">Remittance centers</option>                   
                    </select>
                    <label class="mt-3">Reference number: </label>
                    <input type="text" class="form-control-sm" name="transaction_id">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlFile1" class="text-secondary">
                        Please send a clear proof of sending the top up fee<br>
                        Make sure the transaction code and details are clear</label>
                    <input required type="file" class="form-control-file" name="proofTopUpPayment" id="exampleFormControlFile1"  required>
                </div>
            </div>

        </div>
        <div class="row ">
            <div class="col col-md-12">
            <div class="quickview-btn-cart">
                    <a class="btn-hover-black text-white"  onclick="document.getElementById('coins_top_up').submit();">Submit</a>
            </div>
            </div>
        </div>
    </form>
        </div>
    </div>
@endsection
