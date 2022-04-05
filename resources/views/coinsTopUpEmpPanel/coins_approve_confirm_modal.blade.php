<!-- Large modal -->
<button type="button" class="btn btn-sm btn-warning btn-round m-1" data-toggle="modal" data-target=".confirmedApproved{{$coinsTopUp->id}}">Edit amount</button>

<div class="modal fade bd-example-modal-sm confirmedApproved{{$coinsTopUp->id}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5>Agri coins confirmation dialog</h5>
            </div>
            <div class="modal-body border-0">
                <div class="form-group">
                    Do you want to approve {{$coinsTopUp->amount}} for user {{$coinsTopUp->customer->name ?? 'not available'}} 
                </div>
            </div>
            <div class="modal-footer border-0">
                <a href="/save_approved_agricoins/{{$coinsTopUp->id}}" class="btn btn-primary">Confirm</a>
                <a type="b  utton" class="btn btn-danger text-white" data-dismiss="modal">Cancel</a>
            </div>
        </div>
    </div>
</div>

