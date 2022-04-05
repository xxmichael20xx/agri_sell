@extends('userdash.user_dash_front')
@section('user_dash')
    <div class="col-lg-9">
        <h1 class="lead display-6">My notifications</h1>
        @foreach ($notifs as $notif)

        <div class="row">
                
            <div class="col col-lg-12">
                <div class="card border-0 shadow-lg">
                    <div class="card-header">
                        {{$notif->notification_title}}
                    </div>
                    <div class="card-body">
                    {!! $notif->notification_txt !!}

                    </div>
                    <div class="card-footer">
                        {{$notif->created_at}}
                    </div>
            
                </div>
            </div>

            @php
                $notif_temp_ent = $notif->where('id', $notif->id)->first();
                $notif_temp_ent->is_seen = 'yes';
                $notif_temp_ent->save();
            @endphp

        </div>

        @endforeach

    </div>
@endsection
