@extends('layouts.app')

@section('title')
{!! Auth::guard('employer')->user()->name !!} | Dashboard
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

@stop