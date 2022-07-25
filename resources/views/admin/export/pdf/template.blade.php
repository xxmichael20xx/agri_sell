@extends('layouts.report')
@section('content')
<div class="form-group row">
    <div class="col-12 mb-3">
        <p class="h5">{{ $headers[0][0] }}</p>
    </div>
    <div class="col-12 table-responsive mb-5">
        <table class="table">
            <thead>
                <tr>
                    @foreach ( $headers[1] as $header)
                        <th>{{ $header }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @php
                    foreach ( $data as $item_index => $item ) {
                        foreach ( $item as $value ) {
                            if ( $value == '' || empty( $value ) ) $data->forget( $item_index );
                        }
                    }
                @endphp
                @foreach ( $data as $item )
                    <tr>
                        @foreach ( $item as $value )
                            <td>{{ $value }}</td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="col-12 text-right">
        <b>Validated by: Agrisell Admin</b>
    </div>
</div>
@endsection