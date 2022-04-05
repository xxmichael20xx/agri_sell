<!-- Large modal -->
<button type="button" class="btn btn-warning btn-round m-1" data-toggle="modal" data-target=".bd-example-modal-sm">Edit amount</button>

<div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
    <div class="modal-header border-0">
       <h5>Enter new value</h5>
</div>
        <div class="modal-body border-0">
        <div class="form-group">
            <form method="POST" id="edit_amount" action="/admin/coins_top_up/submit_edit_amount" enctype="multipart/form-data">
            @csrf
            <input type="hidden" class="form-control" name="trans_id" value="{{$user->id}}" >

            <input type="number" class="form-control" name="new_amount" value="{{$user->value}}" >
            </form>
         </div>
        </div>
    <div class="modal-footer border-0">
        <button type="submit" form="edit_amount" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

