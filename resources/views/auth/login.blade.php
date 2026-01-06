@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ __('Login') }}</h4>
                    </div>

                    <div class="card-body">
                        <div class="row mb-3 text-center">
                            <div>
                                <p>We use Microsoft 365 for accessing your account.</p>
                                <p>Click the button below to get started.</p>
                            </div>
                            <p>
                                <a href="{{ route('connect') }}">
                                    Login with your Microsoft Account
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
