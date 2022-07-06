@extends('layouts.report')
@section('content')
<div class="form-group row">
    <div class="col-12 table-responsive">
        <table class="table">
            <thead>
                <tr>
                    @foreach ( $headers[1] as $header)
                        <th>{{ $header }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
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
</div>
@endsection