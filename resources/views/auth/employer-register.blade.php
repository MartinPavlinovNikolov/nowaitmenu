@extends('layouts.app')

@section('title', 'Registration')

@section('styles')
    <link rel="stylesheet" href="{{ asset('/css/employer/dashboard.css') }}">
@endsection

@section('nav')
    @include('auth._employer_nav')
@endsection

@section('content')
<div class="row">
    <div class="col-6 offset-3">
        <div class="panel panel-default text-center">
            <div class="panel-heading"><h1>Employer Register</h1></div>

            <div class="panel-body">
                <form class="form" method="POST" action="{{ route('employer.register') }}">
                    {{ csrf_field() }}

                    <div class="form-group row {{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="col-4 control-label">Name: </label>

                        <div class="col-8">
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                            @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row {{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-4 control-label">E-Mail Address: </label>

                        <div class="col-8">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                            @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row {{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="col-4 control-label">Password: </label>

                        <div class="col-8">
                            <input id="password" type="password" class="form-control" name="password" required>

                            @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password-confirm" class="col-4 control-label">Confirm Password</label>

                        <div class="col-8">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">
                                Register
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('/js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('/js/employer/dashboard.js') }}"></script>
@stop