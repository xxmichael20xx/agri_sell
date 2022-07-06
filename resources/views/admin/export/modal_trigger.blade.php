@if ( $type == "admin_shops" )
    <a class="dropdown-item clickable" data-toggle="modal" data-target="#{{ $key }}-full-approved">CSV/PDF - Full Approved</a>
    <a class="dropdown-item clickable" data-toggle="modal" data-target="#{{ $key }}-top-performing">CSV/PDF - Top Performing</a>
@endif

@if ( $type == "admin_users" || $type == "admin_transactions" || $type == 'seller_payout' )
    <a class="dropdown-item clickable" data-toggle="modal" data-target="#{{ $key }}">CSV/PDF - Full List</a>
@endif

@if ( $type == "admin_refunds" || $type == "admin_payout" )
    <a class="dropdown-item clickable" data-toggle="modal" data-target="#{{ $key }}">CSV/PDF - Full Report</a>
@endif

@if ( $type == "admin_orders" )
    <a class="dropdown-item clickable" data-toggle="modal" data-target="#{{ $key }}">CSV/PDF - Full Orders</a>
@endif

@if ( $type == "admin_activities" )
    <a class="dropdown-item clickable" data-toggle="modal" data-target="#{{ $key }}">CSV/PDF - Activity Log Report</a>
@endif

@if ( $type == "seller_dashboard" )
    <a class="dropdown-item clickable" data-toggle="modal" data-target="#{{ $type }}-products-list">CSV/PDF - Products List</a>
    <a class="dropdown-item clickable" data-toggle="modal" data-target="#{{ $type }}-orders-full">CSV/PDF - Orders Full</a>
    <a class="dropdown-item clickable" data-toggle="modal" data-target="#{{ $type }}-monthly-sale">CSV/PDF - Monthly Sale</a>
@endif
