@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-8">
                <div class="card border-0 shadow-lg">
                    <div class="card-header border-0 text-white bg-success">{{ __('Valid id upload') }}</div>

                    <div class="card-body">
                        <div class="row ">
                            <div class="col col-md-12">
                                <p>&nbsp;We are committed to maintaining the accuracy, confidentiality, and security of
                                    your personally identifiable
                                    information ("Personal Information"). As part of this commitment, our privacy policy
                                    governs our actions as they
                                    relate to the collection, use and disclosure of Personal Information. Our privacy
                                    policy is based upon the
                                    values set by the Phil Standards Association's Model Code for the Protection of
                                    Personal
                                    Information and Philippinnes'<em>Personal Information Protection</em>&nbsp;<em>and
                                        Electronic Documents
                                        Act</em>.</p>


                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 text-right">
                                <button type="submit" class="btn btn-success w-50" name="submit" value="Submit">
                                    {{ __('I agree and Register') }}
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
