@extends('layouts.front')
@section('content')
<div class="container">
    <div class="row no-gutters">
        @include('cart.checkout_area')
        @include('cart.billing_details')

      <input type="hidden" name="isUsingAgCoins" id="isUsingAgCoinsVal" value="">
      <input type="hidden" name="totalCheckoutCharges" id="totalCheckoutAmountCharges" value="">
    </div>
</div>
<script>
    var totalCheckoutCharges = document.getElementById('totalCheckoutAmountCharges');
    var isUsingAgCoins = document.getElementById('isUsingAgCoinsVal');

    totalCheckoutCharges.value = {!! \Cart::session(auth()->id())->getTotalNoShippingFee() !!};
    isUsingAgCoins.value = 'true';

    function onchangecbox() {
        var cbox_inst = document.getElementById('cbox');
        var cbox_value = document.getElementById('cboxval');
        var order_total_delivery = document.getElementById('order_total_delivery');
        var order_total_pickup = document.getElementById('order_total_pickup');
        var delivery_select = document.getElementById('delivery_payment_option');
        var shipping_fee_dialog = document.getElementById('shipping_fee_dialog');
        

        // pick up option checked
        if (cbox_inst.checked == true) {
            cbox_value.value = "yes";
            shipping_fee_dialog.style.display = "none";
            order_total_delivery.style.display = "none";
            delivery_select.style.display = "none";
            order_total_pickup.style.display = "initial";

        } else {
            // delivery related details will be shown
            shipping_fee_dialog.style.display = "initial";
            order_total_delivery.style.display = "initial";
            delivery_select.style.display = "initial";
            // pick up option failed
            cbox_value.value = "no";
            order_total_pickup.style.display = "none";
        }
    }

    function change_payment_option() {
        var delivery_payment_option_value = document.getElementById('delivery_payment_option_select').value;
        var totalCheckoutCharges = document.getElementById('totalCheckoutAmountCharges');
        var order_total_with_shipping_fee = document.getElementById('order_total_with_shipping_fee').innerHTML;
        var order_total_without_shipping_fee = document.getElementById('order_total_without_shipping_fee').innerHTML;

        var isUsingAgCoins = document.getElementById('isUsingAgCoinsVal');
        if (delivery_payment_option_value == 'cash_on_delivery') {
            isUsingAgCoins.value = 'false';
            totalCheckoutCharges.value = {!! \Cart::session(auth()->id())->getTotalNoShippingFee() !!};

        } else if (delivery_payment_option_value == 'agrisell_coins') {
            isUsingAgCoins.value = 'true';
            totalCheckoutCharges.value = {!! \Cart::session(auth()->id())->getTotal() !!};

        } else{
            // still an agrisell coins because the default is blank
            isUsingAgCoins.value = 'true';
            totalCheckoutCharges.value = {!! \Cart::session(auth()->id())->getTotal() !!};
        }
    }

    function validateIfAgcoinsEnough() {
        // to submit checkout cart
        var delivery_payment_option_value = document.getElementById('delivery_payment_option_select').value;
        var form_container_checkout_cart = document.getElementById("billingDetails");
        var isUsingAgCoins = document.getElementById("isUsingAgCoinsVal").value;
        var total_ag_coins = {!! $total_ag_coins !!};
        var total_cart_order_total = document.getElementById('totalCheckoutAmountCharges').value;
        const shippingType = document.querySelector( '#deliver_option option:checked' ).value
        let go = false

        if ( shippingType == 'delivery' ) {
            const town = document.querySelector( '.billing--address[data-type="town"] option:checked' ).value
            const barangay = document.querySelector( '.billing--address[data-type="barangay"] option:checked' ).value

            if ( town == '' || barangay == '' ) {
                Swal.fire({
                    icon: 'info',
                    title: 'Delivery Address',
                    text: 'Please select your delivery address Municipality/Barangay'
                })
                go = false
                
            } else {
                go = true
            }
        } else {
            go = true
        }

        if ( ! go ) return false

        if (isUsingAgCoins == 'true') {
            if (total_ag_coins > total_cart_order_total) {
                form_container_checkout_cart.submit();
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Agri coins',
                    text: 'Not enough Agri Coins'
                })
            }
        } else if (isUsingAgCoins == '') {
            // default agcoins
            if (total_ag_coins > total_cart_order_total) {
                form_container_checkout_cart.submit();
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Agri coins',
                    text: 'Not enough Agri Coins'
                })
            }
        } else if (isUsingAgCoins == 'false') {
            form_container_checkout_cart.submit();
        }
    }


    function deliveryOpt() {
        // d = document.getElementById("select_id").value;
        var cbox_value = document.getElementById('cboxval');
        var totalCheckoutCharges = document.getElementById('totalCheckoutAmountCharges');
        var deliveryOptionValue = document.getElementById("deliver_option").value;

        if (deliveryOptionValue == "pickup") {
            cbox_value.value = "yes";
            totalCheckoutCharges.value = {!! \Cart::session(auth()->id())->getTotalNoShippingFee() !!};

            document.getElementById('seller_contact_details_container').style.display = "initial";
            document.getElementById("contact_details_container").style.display = "none";

            document.getElementById('order_total_pickup').style.display = "initial";
            document.getElementById('order_total_delivery').style.display = "none";

            // document.getElementById('shipping_fee_dialog').style.display = "none";
            document.getElementById('shipping_fee_dialog_additional').classList.add( 'collapse' )

            // document.getElementById("cod_option").style.display = "none";
            // document.getElementById("cop_option").style.display = "initial";

            document.getElementById( 'shipping_fee_dialog' ).style.display = "initial";
            document.getElementById( 'shipping_fee_dialog' ).innerHTML = '₱ 0'
            
        } else if (deliveryOptionValue == "delivery") {
            cbox_value.value = "no";
            totalCheckoutCharges.value = {!! \Cart::session(auth()->id())->getTotal() !!};

            document.getElementById("contact_details_container").style.display = "initial";
            document.getElementById('seller_contact_details_container').style.display = "none";

            document.getElementById('order_total_pickup').style.display = "none";
            document.getElementById('order_total_delivery').style.display = "initial";
            
            document.getElementById('shipping_fee_dialog').style.display = "initial";
            document.getElementById('shipping_fee_dialog_additional').classList.remove( 'collapse' )

            // document.getElementById("cod_option").style.display = "none";
            // document.getElementById("cop_option").style.display = "initial";

            const shipping_fee = document.getElementById( 'shipping_fee_dialog' )
            shipping_fee.style.display = "block";
            shipping_fee.innerHTML = shipping_fee.getAttribute( 'data-shipping' )
        }
    }

    function initdeliveryToggle() {
        document.getElementById('seller_contact_details_container').style.display = "none";
        document.getElementById('contact_details_container').style.visibility = "initial";


        document.getElementById('seller_contact_details_container').style.display = "initial";
        document.getElementById("contact_details_container").style.display = "none";

        document.getElementById('order_total_pickup').style.display = "initial";
        document.getElementById('order_total_delivery').style.display = "none";

        document.getElementById('shipping_fee_dialog').style.display = "none";

        document.getElementById("cod_option").style.display = "none";
        document.getElementById("cop_option").style.display = "initial";
    }
    </script>

    @endsection
