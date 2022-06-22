<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h4 class="card-title">{{ $title ?? 'Users' }}</h4>
        <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" id="report--activity-logs" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Report Generation
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="/export/csv/users/full/{{ $role_id }}" target="_blank">CSV - Full List</a>
                <a class="dropdown-item" href="/export/csv/users/current/{{ $role_id }}" target="_blank">CSV - Current Month</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <div class="toolbar">
            </div>
            <table id="datatable{{ $datatable_index }}" class="table" cellspacing="0" width="100%">
                <thead class=" text-primary">
                    <tr>
                        <th>
                            Name
                        </th>
                        <th>
                            Mobile
                        </th>
                        <th>
                            Address
                        </th>
                        <th>
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>
                            {{$user->name}}
                        </td>
                        <td>
                            {{$user->mobile}}
                        </td>
                        <td>
                            {{$user->address}} {{$user->barangay}} {{$user->town}} {{$user->province}}
                        </td>
                        <td>
                            <a href="/admin/manage_user/{{$user->id}}" class="btn btn-sm btn-primary text-white m-1">More info</a>
                            <a hidden href="/admin/edit_user/{{$user->id}}" class="btn btn-sm btn-warning text-white m-1">Edit</a>
                            @if ($user->role->name != 'admin')
                                <button type="button" data-text="User will deleted!" data-href="/admin/delete_user/{{$user->id}}" class="btn btn-sm btn-danger text-white m-1 btn--delete-confirm">Delete</button>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
    </div>
</div>
</div>