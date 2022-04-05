<div class="nav-tabs-navigation">
    <div class="nav-tabs-wrapper">
        <ul id="tabs" class="nav nav-tabs" role="tablist">
            @php
            $delivery_statuses = App\orderDeliveryStatusModel::all();
            $delivery_status_counter = 0;
            @endphp
            @foreach ($delivery_statuses as $status)
            {{-- The first tab is active --}}
            @if ($delivery_status_counter == 0)
            <li class="nav-item active">
                <a class="nav-link" href="/admin/manage_orders/delivery/{{$status->id}}">{{$status->display_name}}</a>
            </li>
            @elseif ($delivery_status_counter != 7)
            {{-- Not delivery status which is hidden --}}
            <li class="nav-item">
                <a class="nav-link" href="/admin/manage_orders/delivery/{{$status->id}}" >{{$status->display_name}}</a>
            </li>
            @endif
            @php
            $delivery_status_counter++;
            @endphp
            @endforeach
        </ul>
    </div>
</div>
