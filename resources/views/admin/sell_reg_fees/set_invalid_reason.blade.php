<!-- Modal -->
<button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModalCenter{{$user->id}}">Decline</button>

<div class="modal fade" id="exampleModalCenter{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Invalid seller registration remarks</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="row">
        <form method="POST" id="set_invalid_reason_form{{$user->id}}" action="/invalid_sell_reg_status_remarks">
          @csrf
          @method('POST')
          <input type="hidden" name="sell_reg_id" value="{{$user->id}}">
          <select class="selectpicker" data-style="btn btn-primary btn-round w-100" name="invalid_sell_reg_status" form="change_seller_verification_status">
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
          </form>
      </div>
</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" form="set_invalid_reason_form{{$user->id}}" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>