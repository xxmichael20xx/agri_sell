<div class="col-lg-6 col-md-12 col-12 p-5">
    <form id="billingDetails" action="{{ route( 'orders.store') }}" method="post">
        @csrf
        <div class="checkbox-form" onload="initdeliveryToggle()">
            <h3>Shipping Details</h3>
            <div class="row">
                <div class="col-md-12">
                    <div class="country-select" id="">
                        <label>Delivery option</label>
                        <select onchange="deliveryOpt()" id="deliver_option">
                            <option value="pickup">Pickup</option>
                            <option value="delivery">Delivery</option>
                        </select>
                    </div>
                </div>
                <div id="seller_contact_details_container" class="col-12">
                <div class="col-md-12">
                    <div class="col-md-12">
                        <div class="checkout-form-list">
                        @php
                                $previous_shop_entity_id = '1';
                                $shop_entity_obj;
                                $shop_entity_previous;
                                $tmp_txt_shop_id = "";
                                foreach($cartItems as $item){
                                    $shop_entity = App\Shop::find(App\Product::find($item['product_id'])->first()->shop_id)->first();
                                    $shop_entity_id = App\Shop::find(App\Product::find($item['product_id'])->first()->shop_id)->first()->id;                            
                                    $shop_entity_obj = $shop_entity;      
                                    $tmp_txt_shop_id .= $item['id'] . ",";                  
                                }

                        @endphp
                        <label>Shop name</label>

                        <p>{{$shop_entity_obj->name ?? 'not available'}}</p>
                        <label>Seller name</label>
                        <p>{{$shop_entity_obj->owner->name ?? 'not available'}}</p>
                        <label>Address </label>
                        <p>{{$shop_entity_obj->owner->address ?? 'not available'}} {{$shop_entity_obj->owner->barangay ?? 'not available'}} {{$shop_entity_obj->owner->town ?? 'not available'}} {{$shop_entity_obj->owner->province ?? 'not available'}} </p>
                        <label>Mobile</label>
                        <p>{{$shop_entity_obj->owner->mobile ?? 'not available'}}</p>
                        <label>Email</label>
                        <p>{{$shop_entity_obj->owner->email ?? 'not available'}}</p>
                        <label class="dark-highlight text-md text-danger">Note: Please take screenshot of the shop seller details </label>
                        </div>
                        </div>    
                      </div>
                </div>
                <div id="contact_details_container" class="col-12" style="display:none">
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
                <div class="col-6 col-md-12">
                    <div class="checkout-form-list">
                        <label>Address line</label>
                        <input type="text" name="shipping_address" id="" value="{{ $autofill_data->address }}" placeholder="">
                    </div>
                </div>
                <div class="col-6 col-md-6">
                    <div class="checkout-form-list">
                        <label>Municipality</label>
                        <select id="municipality" class="form-control billing--address" data-type="town" onchange="setTown()" required>
                            <option value="" selected disabled>Select municipality</option>
                        </select>
                        {{-- <input type="text" name="shipping_town" value="{{ $autofill_data->town }}" placeholder="Street address"> --}}
                    </div>
                </div>
                <div class="col-6 col-md-6">
                    <div class="checkout-form-list">
                        <label>Barangay</label>
                        <select id="barangay" class="form-control input-lg billing--address" data-type="barangay" onchange="setBarangay()" required>
                            <option value="" disabled selected>Select barangay</option>
                        </select>
                        {{-- <input type="text" name="shipping_barangay" value="{{ $autofill_data->barangay }}" placeholder="Street address"> --}}
                    </div>
                </div>
                <div class="col-6 col-md-6">
                    <div class="checkout-form-list">
                        <label>Province</label>
                        <input type="text" name="shipping_state" value="{{ $autofill_data->province }}" placeholder="Province" readonly>
                    </div>
                </div>
                @php
                    $getSubTotal = \Cart::session(auth()->id())->getSubTotal();
                    $tax = number_format( ( 12 / 100 ) * $getSubTotal );
                @endphp
                <input type="hidden" name="tax" value="{{ $tax }}">
                <input type="hidden" name="shipping_state" value="na" id="" class="form-control">
                <input type="hidden" name="shipping_city" value="na" id="" class="form-control">
                <input type="hidden" name="shipping_zipcode" value="na" id="" class="form-control">

                <input type="hidden" id="brgyval" name="barangay">
                <input type="hidden" id="townval" name="town">
                <input type="hidden" id="provval" name="province">
                </div>
                <style>
                    ::before {
                        display: none;
                        visibility: hidden;
                    }
                </style>
                <div class="col-md-12" >
                    <div class="country-select" id="delivery_payment_option" >
                        <label>Payment option</label>
                        <select name="payment_method" id="delivery_payment_option_select" onchange="change_payment_option()" >
                            @if ($total_ag_coins <  \Cart::session(auth()->id())->getTotal())
                                <option value="cash_on_delivery">Agrisell coins not sufficient ({{$total_ag_coins}})
                                </option>
                            @else
                                <option value="agrisell_coins">Agrisell coins - Available
                                    coins {{$total_ag_coins}}</option>
                                Agrisell coins - Available coins {{$total_ag_coins}}
                            @endif
                            <option value="cash_on_delivery">Cash on delivery/pickup</option>
                        </select>
                    </div>
                </div>
                <script>
              
                </script>
              
                <div class="col-md-12">
                    <div class="checkout-form-list create-acc">
                        <input id="cbox" onclick="onchangecbox()" type="checkbox" hidden>
                        <label hidden>I will pick up the item</label>
                        <input id="cboxval" type="hidden" name="is_pick_up">
                        <label>Order Note:</label>
                        <textarea id="notes" name="notes"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@section( 'additional_scripts' )
<script>
    function setTown() {
        const el = document.getElementById( 'municipality' )
        const tar = document.getElementById( 'townval' )
        tar.value = el.options[el.selectedIndex].text
    }

    function setBarangay() {
        const el = document.getElementById( 'barangay' )
        const tar = document.getElementById( 'brgyval' )
        tar.value = el.options[el.selectedIndex].text
    }

    ( function( $ ) {
        const _token = "{{ csrf_token() }}"
        const shipping_user_id = {{ auth()->user()->id }}
        let shippingData = {}

        $(document).ready(function () {
            load_json_data( 'province' )

            setTimeout( () => {
                $( '#municipality' ).trigger( 'change' )
                $( '#barangay' ).trigger( 'change' )
            }, 2000 )

            function load_json_data( id, parent_id ) {
                var html_code = '';
                $.getJSON( '/province_municipality_barangay.json', function ( data ) {
                    html_code += '<option value="">Select ' + id + '</option>';
                    $.each( data, function ( key, value ) {
                        if ( id == 'province' ) {
                            if ( value.parent_id == '0' ) {
                                html_code += '<option value="' + value.id + '" selected>' + value.name + '</option>';
                            }
                        } else {
                            if ( value.parent_id == parent_id ) {
                                html_code += '<option value="' + value.id + '">' + value.name + '</option>';
                            }
                        }
                    } )
                    $( '#' + id ).html( html_code )
                } )
            }

            var province_id = $( this ).val()
            var province_id = '1'

            if ( province_id != '' ) {
                load_json_data( 'municipality', province_id )

            } else {
                $( '#municipality').html( '<option value="" disabled selected>Select municipality</option>' )
                $( '#barangay').html( '<option value="" disabled selected>Select barangay</option>' )
            }

            $( document ).on( 'load', '#province', function () {
                var province_id = $( this ).val()
                var province_id = '1'
                if ( province_id != '' ) {
                    load_json_data( 'municipality', province_id )

                } else {
                    $( '#municipality' ).html( '<option value="" disabled selected>Select municipality</option>' )
                    $( '#barangay' ).html( '<option value="" disabled selected>Select barangay</option>' )
                }
            })

            $( document ).on( 'change', '#municipality', function () {
                var municipality_id = $( this ).val()

                if ( municipality_id != '' ) {
                    load_json_data( 'barangay', municipality_id )

                } else {
                    $( '#barangay' ).html( '<option value="" disabled selected>Select barangay</option>' )
                }
            })

            const brgy = `{{ $autofill_data->barangay }}`
            const town = `{{ $autofill_data->town }}`

            setTimeout( () => {
                $( '#province' ).val( 1 ).change()

                $.getJSON( '/province_municipality_barangay.json', function ( res ) {
                    const _town = res.find( x => {
                        if ( x.name.trim() == town ) return x
                    } )

                    const _brgy = res.find( x => {
                        if ( _town.id == x.parent_id && x.name.trim() == brgy ) return x
                    } )

                    $( '#municipality' ).val( _town.id ).change()
                    setTimeout( () => {
                        $( '#barangay' ).val( _brgy.id ).change()
                    }, 1500 )
                } )
            }, 1500 )

            $( document ).on( 'change', '.billing--address', function() {
                const type = $( this ).data( 'type' )
                const town = $( '#municipality' ).val()
                let barangay = $( '#barangay' ).val()

                if ( type == 'town' ) {
                    barangay = ''
                    $( '#barangay' ).val( '' )
                }

                if ( town !== '' && barangay !== '' ) {
                    shippingData = { town: town, barangay: barangay, user_id: shipping_user_id }
                    processChange()
                }
            } )
        })

        function debounce( func, timeout = 1500 ) {
            let timer
            return ( ...args ) => {
                clearTimeout( timer )
                timer = setTimeout( () => { func.apply( this, args ) }, timeout )
            }
        }

        function fetchShippingRates() {
            fetch( `/shipping/rates`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': _token,
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify( shippingData ) 
            } ).then( r => r.json() ).then( res => {
                if ( res.success ) {
                    const shipType = $( '#deliver_option' ).val()
                    const ship = $( '#shipping_fee_dialog' )
                    const total = $( '#order_total_delivery' )

                    if ( shipType == 'delivery' ) {
                        ship.attr( 'data-shipping' , `₱ ${res.rate}` )
                        ship.text( `₱ ${res.rate}` )
                        total.text( `₱ ${res.total}` )
                    }
                }
            } )
        }

        const processChange = debounce( () => fetchShippingRates() )

    } )( jQuery )
</script>
@endsection
