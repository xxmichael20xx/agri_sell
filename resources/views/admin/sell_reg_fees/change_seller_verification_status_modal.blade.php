
<!-- Button trigger modal -->
<button type="button" onload="onloaderModal()" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
    Change verification status
</button>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Change verification status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" id="change_seller_verification_status" action="{{ route('change_seller_verification_status') }}">
                    @csrf
                </form>
                <div class="row">
                    <div class="col-12">
                        <input type="hidden" form="change_seller_verification_status" name="inst_id" value="{{$user->id}}">
                        <select class="selectpicker" data-style="btn btn-primary btn-round w-100" name="sell_reg_status" id="sell_reg_status" onchange="showIfInvalid()" form="change_seller_verification_status">
                            @php
                                $option_list = DB::table('seller_payment_reg_rem')->get();
                            @endphp
                            @foreach($option_list as $inst_options)
                                <option value="{{$inst_options->id}}">{{$inst_options->remarks}}</option>
                            @endforeach
                        </select>
                        <div style="display: none" class="dropdown bootstrap-select" id="invalid_sell_reg_status_reason"><select style="display: none !important;" class="selectpicker" data-style="btn btn-primary btn-round w-100" data-id="invalid_sell_reg_status_reason" name="sell_reg_ver_invalid_reason_id" form="change_seller_verification_status" >
                      <select>
                        @php
                            $option_list = DB::table('invalid_sell_reg_reasons')->get();
                            $option_list_counter = 1;
                            @endphp
                            @foreach($option_list as $inst_options)
                            @if ($inst_options->name != 'not_init')
                            <option value="{{$inst_options->name}}">{{$inst_options->slug}}</option>
                            @endif
                            $option_list_counter++;
                            @endforeach
                         </select>
                         </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" form="change_seller_verification_status" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<script>

    function onloaderModal(){
        var invalid_sell_reg_status_container = document.getElementById("invalid_sell_reg_status_reason");
        invalid_sell_reg_status_container.style.display = "none";
    }
    function showIfInvalid(){
        var invalid_sell_reg_status_container = document.getElementById("invalid_sell_reg_status_reason");
        var valueOfSelected = document.getElementById("sell_reg_status").value;
        if(valueOfSelected == '3'){
            invalid_sell_reg_status_container.style.display = "initial";
        }else{
            invalid_sell_reg_status_container.style.display = "none";
        }
    }

</script>
