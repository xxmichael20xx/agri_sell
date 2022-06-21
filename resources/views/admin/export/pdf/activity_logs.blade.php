@extends('layouts.report')
@section('content')
@php
    $regex = '/<[^>]*>[^<]*<[^>]*>/';
@endphp
    <div class="form-group row">
        <div class="col-12 table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Action type</th>
                        <th>Decription</th>
                        <th>User account name</th>
                        <th>Created at</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ( $notifs as $notif )
                        <tr>
                            <td>#{{ $notif->id }}</td>
                            <td>{{ $notif->action_type }}</td>
                            <td>{{ preg_replace( $regex, '', $notif->action_description ) }}</td>
                            <td>{{ $notif->user->name ?? '' }}</td>
                            <td>{{ $notif->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection