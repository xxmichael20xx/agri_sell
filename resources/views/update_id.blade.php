@extends('layouts.front')
@section('content')

<div class="container" style="padding: 150px 0;">
    <div class="form-group row">
        <div class="col-md-8 mx-auto border bg-light rounded px-3 py-5">
            @if ( \Session::has( 'warning' ) )
                <div class="alert alert-warning" role="alert">
                    {{ __('Please select a valid ID') }}
                </div>
            @endif

            <form method="POST" action="/valid-id/update/{{ $id }}" enctype="multipart/form-data">
                @csrf
                <h3>Update Valid ID for verification</h3>
                <p>Reason: {{ $validID->invalid_reason->description }}</p>
                <div class="form-inline">
                    <label class="custom-file-label mb-2" for="upload_file">Upload your ID: </label>
                    <input type="file" name="upload_file" id="upload_file" class="pt-2 mb-3" required>
                </div>

                <button type="submit" class="btn btn-success clickable rounded">Submit</button>
            </form>
        </div>
    </div>
</div>

@endsection