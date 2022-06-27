<div class="card">
    <div class="card-header">
        <h4 class="card-title">Valid id</h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="datatable{{$datatable_index}}" class="table " cellspacing="0" width="100%">
                <thead class="text-primary">
                    <tr>
                        <th>Name</th>
                        <th>Users' ID</th>
                        <th>Status</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ( $users as $user )
                        @if ( $user->owner->name )
                            <tr>
                                <td>
                                    {{ $user->owner->name }}
                                </td>
                                <td>
                                    <img src="{{ asset( 'storage/'.$user->valid_id_path ) }}" height="100" alt="">
                                </td>
                                <td>
                                    @if ($user->is_valid == '1')
                                        <span>Confirmed</span>
                                    @elseif ($user->is_valid == '0')
                                        <span>Denied</span>
                                    @elseif ($user->is_valid == '2')
                                        <span>Pending</span>
                                    @endif
                                </td>
                                <td class="text-right">
                                    <a href="/admin/valid_ids/{{$user->id}}" class="btn btn-sm btn-primary text-white m-1">More info</a>
                                    <a hidden class="btn btn-sm btn-warning text-white m-1"   data-toggle="modal" data-target="#editModal{{$user->id}}" >Edit id image</a>
                                    <div class="modal fade" id="editModal{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{$user->id}}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <div class="col-md-12 col-sm-12 pt-2">
                                                        <h5>Update valid id image</h5>
                                                        <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                                            <div class="fileinput-new thumbnail">
                                                                <img src="{{asset('storage/'.$user->valid_id_path)}}">
                                                            </div>
                                                            <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                                            <div>
                                                                <span class="btn btn-rose btn-round btn-file">
                                                                <span class="fileinput-new">Select image</span>
                                                                <span class="fileinput-exists">Change</span>
                                                                <form id="photoImgEdit{{$user->id}}" method="POST"action="/submit_new_valid_id" enctype="multipart/form-data">
                                                                @csrf
                                                                <input type="hidden" name="user_id" value="{{$user->id}}"/>
                                                                </form>
                                                                <input type="file" form="photoImgEdit{{$user->id}}" name="new_valid_id" />

                                                                </span>
                                                                <a href="javascript:;" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer border-0">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <input type="submit" form="photoImgEdit{{$user->id}}" class="btn btn-primary">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-danger text-white m-1 btn--delete-confirm" data-text="Users' Valid ID will be deleted!" data-href="/admin/delete_valid_id/{{ $user->id }}">Delete</button>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
