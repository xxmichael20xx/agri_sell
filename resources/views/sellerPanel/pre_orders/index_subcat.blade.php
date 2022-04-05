
<div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Manage Pre Orders</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="toolbar">
                                <!--        Here you can write extra buttons/actions for the toolbar              -->
                            </div>
                            <table id="datatable" class="table " cellspacing="0" width="100%">
                                <thead class=" text-primary">
                                <tr><th>
                                        Pre order ref num
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
                                        Quantity
                                    </th>
                                    <th>
                                        Action
                                    </th>
                                </tr></thead>
                                <tbody>
                                @foreach ($pre_orders as $pre_order)
                                @if (isset($pre_order->product->shop->id))                    
                                    @if ($pre_order->product->shop->id == Auth::user()->shop->id)
                                    <tr>
                                        <td>
                                            {{$pre_order->pre_order_id}}
                                        </td>
                                        <td>
                                            {{(isset($pre_order->customer->id) ? $pre_order->customer->name : 'not available')}}                                            
                                        </td>
                                        <td>
                                        {{$pre_order->product->shop->name ?? 'not available'}}
                                        </td>
                                        <td>
                                        {{$pre_order->product->name ?? 'not available'}}
                                        </td>
                                        <td>{{$pre_order->quantity}}</td>
                                        <td>
                                            <form id="{{$pre_order->pre_order_id}}" method="POST" action="{{ route('confirmOrderfrmPreOrderSeller') }}">
                                                @csrf
                                                <input type="hidden" name="pre_order_id" value="{{$pre_order->id}}">
                                            </form>
                                            <button type="submit" form="{{$pre_order->pre_order_id}}" class="btn btn-sm btn-primary btn-round text-white">Move to orders</button>
                                            <a href="/sellerpanel/delete_pre_order/{{$pre_order->id}}" class="btn btn-sm btn-danger btn-round text-white m-1">Delete</a>
                                        </td>
                                    </tr>

                                    @endif
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
</div>