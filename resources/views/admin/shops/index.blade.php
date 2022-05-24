@extends('admin.front')
@section('content')

<div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Manage shops</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                <div class="toolbar">
                  <!--        Here you can write extra buttons/actions for the toolbar              -->
                </div>
                <table id="datatable" class="table " cellspacing="0" width="100%">
                    <thead class=" text-primary">
                      <tr><th>
                        Shop name
                      </th>
                      <th>
                        Shop owner
                      </th>
                      <th>
                        Shop approved date
                      </th>
                      <th>
                        Shop description
                      </th>
             
                   
                      <th class="text-right">
                        Actions
                      </th>
                    </tr></thead>
                    <tbody>
                        @foreach ($shops as $shop)
                        <tr>
                        <td>
                          {{$shop->name ?? 'Not available'}}
                        </td>
                        <td>
                        {{$shop->owner->name ?? 'Not available'}}
                        </td>
                        <td>
                          {{$shop->date_approved}}
                        </td>
                        <td>
                        {{$shop->description ?? 'Not available'}}
                        </td>
                        <td class="text-right">
                        <a href="/admin/manage_shop/{{$shop->id}}" class="btn btn-sm btn-primary text-white m-1">More info</a>
                        <a hidden href="/admin/edit_shop/{{$shop->id}}" class="btn btn-sm btn-warning text-white m-1">Edit</a>
                        <button type="button" data-text="Shop will be deleted!" data-href="/admin/delete_shop/{{$shop->id}}" class="btn btn-sm btn-danger text-white m-1 btn--delete-confirm">Delete</button>
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
@endsection