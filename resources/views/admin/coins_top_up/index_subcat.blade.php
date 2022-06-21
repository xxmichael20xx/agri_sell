<div class="card">
              <div class="card-header">
                <h4 class="card-title">Coins Top up</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                <div class="toolbar">
                  <!--        Here you can write extra buttons/actions for the toolbar              -->
                </div>
                <table id="datatable{{$datatable_index}}" class="table " cellspacing="0" width="100%">
                    <thead class=" text-primary">
                      <tr><th>
                        Name
                      </th>
                      <th>
                        Image
                      </th>
                      <th>
                        Amount requested
                      </th>
                      <th>
                        Remarks
                      </th>
                      <th class="text-right">
                        Actions
                      </th>
                    </tr></thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                        <td>
                          {{$user->owner->name}}
                        </td>
                        
                        <td>
                        <img src="{{asset('storage/'.$user->image_proof)}}" height="100" alt="">
                        </td>
                        <td>
                          {{$user->value}}
                        </td>
                        <td>
                            @if ($user->remarks == '1')
                                <span>Confirmed</span>
                            @elseif ($user->remarks == '0')
                                <span>Denied</span>
                            @endif
                        </td>
                        <td class="text-right">
                            <a href="/admin/coins_top_up/{{$user->id}}" class="btn btn-sm btn-primary text-white m-1">More info</a>
                            @include('admin.coins_top_up.edit_coins_top_up_modal')
                            <a class="btn btn-sm btn-danger text-white m-1"  href="/admin/delete_coins_top_up/{{$user->id}}">Delete</a>
                        </td>
                      </tr>
                        @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>