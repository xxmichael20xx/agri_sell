@extends('voyager::master')

@section('content')
<style>
    ol.breadcrumb.hidden-xs {
        display: none;
    }

</style>
<div class="page-content " style="padding: 20px;">

    <h4>Orders</h4>

    <table class="table">
        <thead>
            <tr>
                <th>Reference number</th>
                <th>Customer name</th>
                <th>Status</th>
                <th>Qty</th>
                <th>Grand total</th>
                <th>Shipping Address</th>
                <th>Contact number</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $subOrder)
                <tr>
                    <td scope="row">
                        {{ $subOrder->order->order_number }}

                    </td>
                    <td>
                    {{ $subOrder->order->shipping_fullname }}

                    </td>
                    <td>
                        {{ $subOrder->status }}

                        @if($subOrder->status != 'completed')
<!-- <br>
                            <a href=" {{ route('seller.order.delivered', $subOrder) }} "
                                class="btn btn-primary btn-sm">mark as delivered</button> -->
                        @endif
                    </td>

                    <td>
                        {{ $subOrder->item_count }}

                    </td>
                    <td>
                    {{ $subOrder->order->grand_total }}

                    </td>

                    <td>
                        {{$subOrder->order->shipping_address}} 
                        {{$subOrder->order->shipping_barangay}} 
                        {{$subOrder->order->shipping_town}}  
                        {{$subOrder->order->shipping_state}} 
                    </td>
                    <td>
                    {{$subOrder->order->shipping_phone}} 

                    </td>
                    <td>
                        <a name="" id="" class="btn btn-primary btn-sm"
                            href="{{ route('seller.orders.show', $subOrder) }}"
                            role="button">View items</a>
                    </td>
                </tr>
            @empty

            @endforelse


        </tbody>
    </table>


    @stop

        @section('javascript')





        @stop
