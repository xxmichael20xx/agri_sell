<div class="col-lg-6 col-md-12 col-12 p-5">
    <form id="billingDetails" action="{{ route('orders.store') }}" method="post">
        @csrf
        <div class="checkbox-form">
            <h3>Shipping Details</h3>
            <div class="row">
                <div id="customer_details_container">
                <div class="col-md-12">
                    <div class="checkout-form-list">
                        <label>Full Name</label>
                        <input type="text" name="shipping_fullname" value="{{ $autofill_data->name }}" placeholder="">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="checkout-form-list">
                        <label>Mobile</label>
                        <input type="text" name="shipping_phone" id="" value="{{ $autofill_data->mobile }}"
                               placeholder="">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="checkout-form-list">
                        <label>Address line</label>
                        <input type="disabled" name="shipping_address" id="" value="{{ $autofill_data->address }}"
                               placeholder="">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="checkout-form-list">
                        <label>Barangay </label>
                        <input type="disabled" name="shipping_barangay" value="{{ $autofill_data->barangay }}"
                               placeholder="Street address">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="checkout-form-list">
                        <label>Municipality </label>
                        <input type="disabled" name="shipping_town" value="{{ $autofill_data->town }}"
                               placeholder="Street address">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="checkout-form-list">
                        <label>Province </label>
                        <input type="disabled" name="shipping_state" value="{{ $autofill_data->province }}"
                               placeholder="Street address">
                    </div>
                </div>
                <input type="hidden" name="shipping_state" value="na" id="" class="form-control">
                <input type="hidden" name="shipping_city" value="na" id="" class="form-control">
                <input type="hidden" name="shipping_zipcode" value="na" id="" class="form-control">
                <style>
                    ::before {
                        display: none;
                        visibility: hidden;
                    }
                </style>
                </div>
                <div class="col-md-12" >
                    <div class="country-select" id="delivery_payment_option">
                        <label>Payment option</label>
                        <select>
                            @if ($total_ag_coins <  \Cart::session(auth()->id())->getTotal())
                                <option value="cash_on_delivery">Agrisell coins not sufficient ({{$total_ag_coins}})
                                </option>

                            @else
                                <option value="agrisell_coins">Agrisell coins - Available
                                    coins {{$total_ag_coins}}</option>
                                Agrisell coins - Available coins {{$total_ag_coins}}
                            @endif
                            <option value="cash_on_delivery">Cash on delivery</option>
                            

                        </select>
                    </div>
                </div>
                <script>
                function deliveryOpt() {
                    // d = document.getElementById("select_id").value;
                    alert("delivery options changed");
                    contact_user_container = document.getElementById("customer_details_container");
                    contact_user_container.style.visibility = "none";
                }
                </script>
                <div class="col-md-12">
                    <div class="country-select" id="">
                        <label>Delivery option</label>
                        <select onchange="deliveryOpt()" id="deliver_option">
                            <option value="pickup">Pickup</option>
                            <option value="delivery">Delivery</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="checkout-form-list create-acc">
                        <input id="cbox" onclick="onchangecbox()" type="checkbox">
                        <label>I will pick up the item</label>

                        <input id="cboxval" type="hidden" name="is_pick_up">
                        <textarea id="notes" name="notes" placeholder="Pick-up">
                        </textarea>
                    </div>
                </div>
            </div>

        </div>
    </form>
</div>
