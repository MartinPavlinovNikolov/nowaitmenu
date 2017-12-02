@extends('layouts.app')

@section('title')
Admin-Settings
@stop

@section('nav')
<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
        {{ Auth::guard('admin')->user()->name }} <span class="caret"></span>
    </a>

    <ul class="dropdown-menu">
        <li>
            <a href="#"
               onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();">
                Logout
            </a>
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </li>
    </ul>
</li>
@stop

@section('content')

<!-- debuging purpose -->
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        @component('components.who')
        @endcomponent
    </div>
</div>

<h2>change password</h2>
@if(count($errors) > 0)
@foreach($errors->all() as $error)
<p class="danger">{{ $error }}</p>
@endforeach
@endif
<form action="{{ route('admin.settings.submit') }}" method="POST">
    {{ csrf_field() }}
    <input type="password" name="password" value="{{ old('password') }}" placeholder="current password">
    <input type="password" name="new_password" value="{{ old('new_password') }}" placeholder="new password">
    <input type="password" name="new_password_repeat" value="{{ old('new_password_repeat') }}" placeholder="new password repeat">
    <button type="submit">Change Password</button>
</form>
@stop