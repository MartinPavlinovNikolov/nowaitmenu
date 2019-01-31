@extends('layouts.app')

@section('title', 'Admin | Settings')

@section('styles')
<link rel="stylesheet" href="{{ asset('/css/admin/dashboard.css') }}">
@stop

@section('nav')
    @include('admin._nav')
@endsection

@section('content')
@if(count($errors) > 0)
@foreach($errors->all() as $error)
<p class="danger">{{ $error }}</p>
@endforeach
@endif

<div class="row">
    <div class="col-6 offset-3">
        <div class="panel panel-default">
            <div class="panel-heading text-center">
                <h2>Change password</h2>
            </div>
            
            <div class="panel-body">
                <form class="form" method="POST" action="{{ route('admin.settings.update', Auth::guard('admin')->user()->id) }}">
                    {{ method_field('PUT') }}
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