@extends('userdash.user_dash_front')
@section('user_dash')
    <div class="col-lg-9">
        <h1 class="lead display-6">My notifications</h1>
        <div class="accordion" id="accordionNotifications">
            @foreach ( $notifs as $notif )
                <div class="card">
                    <div class="card-header clickable" id="heading-{{ $notif->id }}">
                        <h2 class="mb-0">
                            <button class="btn btn-block btn-link text-left text-dark font-weight-bold clickable" type="button" data-toggle="collapse" data-target="#notification-{{ $notif->id }}" aria-expanded="false" aria-controls="notification-{{ $notif->id }}">
                                {{ $notif->notification_title }}
                            </button>
                        </h2>
                    </div>
                
                    <div id="notification-{{ $notif->id }}" class="collapse" aria-labelledby="heading-{{ $notif->id }}" data-parent="#accordionNotifications">
                        <div class="card-body">
                            {!! $notif->notification_txt !!}
                            <br>
                            Date notified: {{ AppHelpers::humanDate( $notif->created_at ) }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
