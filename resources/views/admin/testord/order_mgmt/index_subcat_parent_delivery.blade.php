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
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#{{$status->name}}" role="tab"
                    aria-expanded="true">{{$status->display_name}}</a>
            </li>
            @elseif ($delivery_status_counter != 7)
            {{-- Not delivery status which is hidden --}}
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#{{$status->name}}" role="tab"
                    aria-expanded="false">{{$status->display_name}}</a>
            </li>
            @endif
            @php
            $delivery_status_counter++;
            @endphp
            @endforeach
        </ul>
    </div>
</div>
<div id="my-tab-content" class="tab-content">
    @php
    $delivery_statuses = App\orderDeliveryStatusModel::all();
    $delivery_status_counter = 0;
    @endphp
    @foreach ($delivery_statuses as $status)
    {{-- The first tab is active --}}
    @if ($delivery_status_counter == 0)
    <div class="tab-pane active" id="{{$status->name}}" role="tabpanel" aria-expanded="true">
        <div class="col-md-12">
            @include('admin.order_mgmt.index_subcat_child_delivery')
        </div>
    </div>
    @elseif ($delivery_status_counter != 7)
    {{-- Not delivery status which is hidden --}}
    <div class="tab-pane" id="{{$status->name}}" role="tabpanel" aria-expanded="false">
        <div class="col-md-12">
        @include('admin.order_mgmt.index_subcat_child_delivery')
        </div>
    </div>
    @endif
    @php
    $delivery_status_counter++;
    @endphp
    @endforeach
</div>