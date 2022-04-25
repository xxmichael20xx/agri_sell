@extends( $layout )
@section('content')
    <div class="content">
        <div class="form-group row">
            <div class="col-4 mx-auto text-center">
                <img src="/cliparts/401-error.png" class="img-fluid" />
                <a class="btn btn-lg btn-primary" href="{{ $backUrl }}">Go Back</a>
            </div>
        </div>
    </div>
@endsection