@extends('layouts.app')

@section('title', 'Admin | Settings')

@section('nav')
<div class="col offset-1">
    <h1 class="lead"><a href='{{ url('/') }}'>NoWaitMenu-Logo</a></h1>
</div>

<div class="col-4 align-content-center">
    <div class="row flex-row justify-content-around">
        <div class="col">
            <div>{{ Auth::guard('admin')->user()->name }}</div>
        </div>
        <div>|</div>
        <div class="col">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        </div>
        <div>|</div>
        <div class="col">
            <a href="#"onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                Logout
            </a>
        </div>
    </div>
</div>
<form id="logout-form" action="{{ route('admin.logout') }}" method="POST">
    {{ csrf_field() }}
</form>
@endsection

@section('content')
<h2>change password</h2>
@if(count($errors) > 0)
@foreach($errors->all() as $error)
<p class="danger">{{ $error }}</p>
@endforeach
@endif

<div class="row">
    <div class="col-6 offset-3">
        <div class="panel panel-default">
            <div class="panel-heading text-center">
                <h1>Change password</h1>
            </div>

            <div class="panel-body">
                <form class="form" method="POST" action="{{ route('admin.settings.submit') }}">
                    {{ csrf_field() }}

                    <div class="form-group row {{ $errors->has('current_password') ? ' has-error' : '' }}">
                        <label for="current-password" class="col-4 control-label">Current Password: </label>

                        <div class="col-8">
                            <input id='current-password' class="form-control" type="password" name="current_password" value="{{ old('current_password') }}">

                            @if ($errors->has('current_password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('current_password') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row {{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="col-4 control-label">New Password: </label>

                        <div class="col-8">
                            <input id='password' class="form-control" type="password" name="password" value="{{ old('password') }}">

                            @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        <label for="password_confirmation" class="col-4 control-label">Re-enter Password: </label>

                        <div class="col-8">
                            <input id='password_confirmation' class="form-control" type="password" name="password_confirmation" value="{{ old('password_confirmation') }}">

                            @if ($errors->has('password_confirmation'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">
                                Change it
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop