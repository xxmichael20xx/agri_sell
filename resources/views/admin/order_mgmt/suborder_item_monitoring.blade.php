@extends('admin.front')
@section('content')
<div class="content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Order products monitoring</h5>
                </div>
                <div class="card-body">
                    <table class="table" class="table" cellspacing="0" width="100%">
                        <thead class="text-primary">
                            <tr>
                                <th></th>
                                <th>Created by</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Date reflected</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($product_monitoring_logs as $product_monitoring_ent)
                                <tr>
                                    <td>
                                        <div class="monitor--logs-image" style="background-image: url('/storage/{{ $product_monitoring_ent->item_image }}');" ></div>
                                    </td>
                                    <td>{{ $product_monitoring_ent->created_by_user->name ?? 'not available' }}</td>
                                    <td>{{ $product_monitoring_ent->sub_order_item->product->name ?? 'not available' }}</td>
                                    <td>{{ $product_monitoring_ent->status}}</td>
                                    <td>{{ AppHelpers::numeric( $product_monitoring_ent->sub_order_item->quantity ) ?? 'not available' }}</td>
                                    <td>₱ {{ AppHelpers::numeric( $product_monitoring_ent->sub_order_item->price ) ?? 'not available' }}</td>
                                    <td>{{ $product_monitoring_ent->sub_order_item->sub_order_parent->updated_at ?? 'not available' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td></td>
                                    <td>No result(s)</td>
                                    <td>No result(s)</td>
                                    <td>No result(s)</td>
                                    <td>No result(s)</td>
                                    <td>No result(s)</td>
                                    <td>No result(s)</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection