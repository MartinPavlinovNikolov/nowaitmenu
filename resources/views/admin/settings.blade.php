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
<form method="POST" action="{{ route('admin.settings.submit') }}">
    {{ csrf_field() }} 
    Current Password: <input type="password" name="current-password" value="{{ old('current-password') }}" placeholder="Current Password">
    New Password: 
    <input type="password" name="password" value="{{ old('password') }}" placeholder="New Password">
    Re-enter Password: 
    <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" placeholder="Re-enter Password">
    <button type="submit">Change it</button>
</form>
@stop