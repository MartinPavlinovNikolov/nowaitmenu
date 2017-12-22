@extends('layouts.app')

@section('title', 'Admin | Login')

@section('content')
<div class="row">
    <div class="col-6 offset-3">
        <div class="panel panel-default">
            <div class="panel-heading text-center">
                <h1>Admin Login</h1>
            </div>

            <div class="panel-body">
                <form class="form" method="POST" action="{{ route('admin.login.submit') }}">
                    {{ csrf_field() }}

                    <div class="form-group row {{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="col-4 control-label">Name: </label>

                        <div class="col-8">
                            <input id="name" type="name" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                            @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row {{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="col-4 control-label">Password</label>

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
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">
                                Login as Admin
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
<script src="{{ asset('/js/admin/dashboard.js') }}"></script>
@endsection