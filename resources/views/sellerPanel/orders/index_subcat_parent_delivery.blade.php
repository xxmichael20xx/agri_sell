@php
    $links = array(
        array( 1, 'Pending' ),
        array( 7, 'Cancelled' ),
        array( 2, 'Confirmed' ),
        array( 9, 'Ready for pickup' ),
        array( 3, 'Picked up by rider' ),
        array( 4, 'Out of delivery' ),
        array( 6, 'Delivery failed' ),
        array( 5, 'Completed' ),
    );
@endphp
<div class="nav-tabs-navigation">
    <div class="nav-tabs-wrapper">
        <ul id="tabs" class="nav nav-tabs" role="tablist">
            @foreach ( $links as $link )
                <li class="nav-item">
                    <a class="nav-link font-weight-bold {{ $status_id == $link[0] ? 'active' : '' }}" href="/sellerpanel/manage_orders/delivery/{{ $link[0] }}">{{ $link[1] }}</a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
