@extends('admin.front')
@section('content')

<div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Refund management</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                <div class="toolbar">
                  <!--        Here you can write extra buttons/actions for the toolbar              -->
                </div>
                <table id="datatable" class="table " cellspacing="0" width="100%">
                    <thead class=" text-primary">
                      <tr>
                         <th>
                          Refund reference id
                          </th>
                        <th>
                        Customer name
                      </th>
                      <th>
                        Shop
                      </th>
                      <th>
                        Product name
                      </th>
                      <th>
                        Status
                      </th>
                      <th class="text-right">
                        Actions
                      </th>
                    </tr></thead>
                    <tbody>
                        @foreach ($refund_reqs as $refund_req)
                        <tr>
                          <td>
                              {{$refund_req->refund_ref_id}}
                          </td>
                        <td>
                          {{$refund_req->customer->name ?? 'not available'}}
                        </td>
                        <td>
                           {{$refund_req->product->shop->name ?? 'not available'}}
                        </td>
                        <td>
                           {{$refund_req->product->name ?? 'not available'}}
                        </td>
                        <td>
                          {{$refund_req->status->slug ?? 'not available'}}
                        </td>
                        <td class="text-right">
                          <a class="btn btn-sm btn-danger btn-round text-white m-1" href="/admin_refund/more_info/{{$refund_req->id}}">More actions</a>
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