@php
    $links = array(
        array( 1, 'Pending' ),
        array( 6, 'Confirmed' ),
        array( 2, 'Ready to pickup' ),
        array( 3, 'Cancelled' ),
        array( 5, 'Completed' ),
    );
@endphp
<div class="nav-tabs-navigation">
    <div class="nav-tabs-wrapper">
        <ul id="tabs" class="nav nav-tabs" role="tablist">
            @foreach ( $links as $link )
                <li class="nav-item">
                    <a class="nav-link font-weight-bold {{ $status_id == $link[0] ? 'active' : '' }}" href="/sellerpanel/manage_orders/pickup/{{ $link[0] }}">{{ $link[1] }}</a>
                </li>
            @endforeach
        </ul>
    </div>
</div>