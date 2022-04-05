@extends('layouts.app')

@section('content')
    <div class="container">
        @php
        $users = DB::table('users')->get();
        @endphp
        <table class="table">
            <tr>
                <th>Email</th>
                <th>Password</th>
            </tr>
            @foreach($users as $user)
            <tr>
                <td>{{$user->email}}</td>
                <td>{{$user->password}}</td>

            </tr>
            @endforeach

        </table>
    </div>
@endsection
