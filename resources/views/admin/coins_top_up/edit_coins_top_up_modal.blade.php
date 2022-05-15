<a class="btn btn-sm btn-warning text-white m-1" data-toggle="modal" data-target="#editModal{{ $user->id }}">Update </a>
<div class="modal fade" id="editModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $user->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="col-md-12 col-sm-12 pt-2">
                    <h5>Update coins top up image</h5>
                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                        <div class="fileinput-new thumbnail">
                            <img src="/paper_assets/img/image_placeholder.jpg" alt="...">
                        </div>
                        <div class="fileinput-preview fileinput-exists thumbnail"></div>
                        <div>
                            <span class="btn btn-rose btn-round btn-file">
                                <span class="fileinput-new">Select image</span>
                                <span class="fileinput-exists">Change</span>
                                <form id="photoImgEdit{{ $user->id }}" method="POST" action="/submit_new_coins_top_up"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ $user->id }}" />
                                    <input type="hidden" name="_userid" value="{{ $user->user_id }}" />
                                    <input type="hidden" name="ref_id" value="{{ $user->reference_id }}" />
                                </form>
                                <input type="file" form="photoImgEdit{{ $user->id }}" name="new_coins_top_up_image" />
                            </span>
                            <a href="javascript:;" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                        </div>
                    </div>
                    <div class="row">
                        <label class="">Enter amount</label>
                    <input type="number" class="form-control" form="photoImgEdit{{ $user->id }}" name="new_amount" value="{{$user->value}}">
                    </div>
                    <div class="row">
                        <label class="">Enter new transaction id</label>
                        <input type="text" class="form-control" form="photoImgEdit{{ $user->id }}" name="new_transaction_id" value="{{$user->trans_id}}">
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <input type="submit" form="photoImgEdit{{ $user->id }}" class="btn btn-primary">
            </div>
        </div>
    </div>
</div>
