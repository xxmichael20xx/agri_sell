@extends('sellerPanel.front')
@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-navigation">
                <div class="nav-tabs-wrapper">
                    <ul id="tabs" class="nav nav-tabs" role="tablist">
                        @php
                            $tabs = array(
                                array( 'crops', 'Crops', 1 ),
                                array( 'vegetables', 'Vegetables', 2 ),
                                array( 'fruits', 'Fruits', 3 ),
                                array( 'livestocks', 'Livestocks', 4 ),
                                array( 'seeds', 'Seeds', 5 ),
                                array( 'grains', 'Grains', 6 ),
                            );
                        @endphp
                        @foreach ( $tabs as $index => $tab )
                            @php
                                $active = false;

                                if ( ! isset( $_GET['type'] ) && $index == 0 ) {
                                    $active = true;
                                }

                                if ( isset( $_GET['type'] ) ) {
                                    $type = $_GET['type'];

                                    if ( $type == $tab[0] ) $active = true;
                                }
                            @endphp
                            <li class="nav-item">
                                <a class="nav-link {{ $active ? 'active' : 'false' }}" data-toggle="tab" href="#{{ $tab[0] }}">{{ $tab[1] }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div id="my-tab-content" class="tab-content">
                @foreach ( $tabs as $index => $tab )
                    @php
                        $active = false;

                        if ( ! isset( $_GET['type'] ) && $index == 0 ) $active = true;

                        if ( isset( $_GET['type'] ) ) {
                            $type = $_GET['type'];

                            if ( $type == $tab[0] ) $active = true;
                        }
                    @endphp
                    <div class="tab-pane {{ $active ? 'active' : '' }}" id="{{ $tab[0] }}">
                        <div class="col-md-12">
                            @include('sellerPanel.products.index_subcat', ['table' => $tab[0], 'id' => $tab[2]])
                        </div>
                    </div>
                @endforeach
            </div>  
        </div>
    </div>
</div>
@endsection

@section('custom-scripts')
    <script>
        window.onload = () => {
            const tables = [ 'crops', 'vegetables', 'fruits', 'livestocks', 'seeds', 'grains' ]
            tables.forEach( function( el ) {
                $( `#datatable-${el}` ).DataTable()
            } )
        }
    </script>
@endsection
