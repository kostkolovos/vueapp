@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        {{ __('You are logged in!') }} <br>
                            <a href="/page" class="sidebox-close position-absolute text-muted text-large font-weight-light">Page</a> <br>
                            <a href="/users" class="sidebox-close position-absolute text-muted text-large font-weight-light">Users</a> <br>
                            <a href="/question_category" class="sidebox-close position-absolute text-muted text-large font-weight-light">Question Category</a><br>
                            <a href="/question" class="sidebox-close position-absolute text-muted text-large font-weight-light">Question</a>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
