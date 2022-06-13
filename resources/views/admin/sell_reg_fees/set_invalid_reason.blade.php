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
        <div class="form-group row py-4">
          <form method="POST" id="set_invalid_reason_form{{$user->id}}" action="/invalid_sell_reg_status_remarks" class="col-12">
            @csrf
            @method('POST')
            <input type="hidden" name="sell_reg_id" value="{{$user->id}}">
            <select name="invalid_sell_reg_status" id="invalid_sell_reg_status" class="custom-select" required>
              <option value="" selected disabled>Select an option</option>
              @php
                $option_list = DB::table( 'invalid_sell_reg_reasons' )->get();
              @endphp
              @foreach($option_list as $inst_options)
                @if ( $inst_options->name != 'not_init' )
                  <option value="{{ $inst_options->name }}">{{ $inst_options->slug }}</option>
                @endif
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