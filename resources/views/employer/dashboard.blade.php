@extends('layouts.app')

@section('title')
Employer
@stop

@section('nav')
<div class="col offset-1">
    <h1 class="lead"><a href='{{ url('/') }}'>NoWaitMenu-Logo</a></h1>
</div>

<div class="col-4 align-content-center">
    <div class="row flex-row justify-content-around">
        <div class="col">
            <div>{{ Auth::guard('employer')->user()->name }}</div>
        </div>
        <div>|</div>
        <div class="col">
            <a href="#"onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                Logout
            </a>
        </div>
    </div>
</div>
<form id="logout-form" action="{{ route('employer.logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
</form>
@endsection

@section('content')
<h2>HELLO EMPLOYER</h2>

<!-- debuging purpose -->
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        @component('components.who')
        @endcomponent
    </div>
</div>
@stop