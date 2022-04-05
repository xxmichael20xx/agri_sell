@extends('layouts.app_enlink')
@section('content')
<div class="container">
    <div class="row ">
        <div class="col-12">
        <h1 class="col-12 text-muted lead text-center">Please pay your seller registration fee through payment channels</h1>
        </div>
        <div class="col-12">
        <p class="col-12 text-muted text-center">Pay the seller registration fee in the exact amount of 100 pesos</p>
        </div>        
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
                    <a href="https://cares.paymaya.com/s/article/Sending-Money-to-another-PayMaya-account" class="btn btn-info text-white w-100">More info</a>
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
                    <a href="https://www.moneymax.ph/personal-finance/articles/remittance-centers-philippines" class="btn btn-info text-white w-100">More info</a>
                </div>
            </div>
        </div>
    </div>
    <form method="POST" action="confirm_registration_fee" enctype="multipart/form-data">
        @csrf
        <div class="row justify-content-center mt-5">

            <div class="col col-lg-12 col-md-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="form-group row">
                            
                            <label for="exampleFormControlFile1 text-secondary">
                                Please send a clear proof of sending the fee<br>
                                Click the choose file to upload the picture</label>
                            <input type="file" class="form-control-file" name="proofSellRegPayment" id="exampleFormControlFile1" required>
                            
                        </div>
                        <div class="form-group row">
                            
                            <label for="trans_code col-4">
                                Transaction code</label>                          
                            <input type="text" class="form-control col-12" name="trans_code" id="transaction_code" required>
                                    
                        </div>
                </div>
                </div>
            </div>

        </div>
    
      
        <div class="row justify-content-center mt-5">
            <div class="col col-md-5">
                <button type="submit" class="btn btn-primary w-100 p-2">Submit</button>
            </div>
        </div>
    </form>
</div>
@endsection
