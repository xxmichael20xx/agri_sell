@extends('admin.front')
@section('content')
<div class="content">
<div class="row">
  <div class="col-12">
	<div class="card">
              <div class="card-header">
                <h4 class="card-title">Notifications</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                <div class="toolbar">
                  <!--        Here you can write extra buttons/actions for the toolbar              -->
                </div>
                <table id="datatable1" class="table " cellspacing="0" width="100%">
                    <thead class=" text-primary">
                      <tr><th>
                        Action type
                      </th>
                      <th>
                        Decription
                      </th>
                      <th>
                      	User account name
                      </th>
                      <th>
                      	Created at
                      </th>
                     
                    
                    </tr></thead>
                    <tbody>
                        @foreach ($notifs as $notif)
                        <tr>
                        <td>
                       	{{$notif->action_type}}
                        </td>
                        <td>
                        {{$notif->action_description}}
                        </td>
                        <td>
                        {{$notif->user->name}}
                        </td>
                        <td>
                        {{$notif->created_at}}
                        </td>
                      </tr>
                        @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
</div>
</div>
</div>
@endsection