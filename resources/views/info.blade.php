@extends( $layout )
@section('content')
    <div class="content">
        <div class="form-group row">
            <div class="col-4 mx-auto text-center">
                <img src="/cliparts/info.png" class="img-fluid" />
                @if ( isset( $title ) && $title )
                    {!! $title !!}
                @endif
                <a class="btn btn-lg btn-primary" href="{{ $backUrl }}">Back to home</a>
            </div>
        </div>
    </div>
@endsection