<h2>Checkout</h2>


        <h4>Shipping Information</h4>
<form action="{{ route('orders.store') }}" method="post">
            @csrf
            <div class="row">
            <div class="form-group col-6">
                <label for="">Full Name</label>
                <input type="text" name="shipping_fullname" value="{{ $autofill_data->name }}" id=""
                    class="form-control">
            </div>
            <div class="form-group col-6">
                <label for="">Mobile</label>
                <input type="text" name="shipping_phone" id="" value="{{ $autofill_data->mobile }}"
                    class="form-control">
            </div>
            </div>
            <div class="row" >
            <div class="form-group col-8">
                    <label for="">Address line </label>
                    <input type="text"  name="shipping_address" id="" value="{{ $autofill_data->address }}"
                        class="form-control">
                </div>
                <div class="form-group col-4">
                    <label for="">Barangay</label>
                    <input type="text"  name="shipping_barangay" value="{{ $autofill_data->barangay }}" id="" class="form-control">
                </div>
            </div>
            <div class="row">
            <div class="form-group col-4">
                    <label for="">Town/City</label>
                    <input type="text"  name="shipping_town" value="{{ $autofill_data->town }}" id="" class="form-control">
                </div>
                <div class="form-group col-4">
                    <label for="">Province</label>
                    <input type="text"  name="shipping_town" value="{{ $autofill_data->province }}" id="" class="form-control">
                </div>
            </div>

                <h4>Payment option</h4>

                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" checked class="form-check-input" name="payment_method" id=""
                            value="cash_on_delivery">
                        Cash on delivery
                        <br>
                        @if ($total_ag_coins <  \Cart::session(auth()->id())->getTotal())
                               <input type="radio"  class="form-check-input" name="payment_method" id=""
                            value="agri_coins">
                            Agrisell coins not sufficient ({{$total_ag_coins}}) 
                            @else
                            <input type="radio" checked class="form-check-input" name="payment_method" id=""
                            value="agrisell_coins">
                            Agrisell coins - Available coins {{$total_ag_coins}}
                            
                            @endif
                     
                    </label>
                </div>
                <input type="hidden" name="shipping_state" value="na" id="" class="form-control">
                <input type="hidden" name="shipping_city" value="na" id="" class="form-control">
<input type="hidden" name="shipping_zipcode" value="na" id="" class="form-control">
<button type="submit" class="btn btn-dark w-100 mt-3">Place Order</button>
               

               </form>