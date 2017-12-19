@extends('layouts.app')

@section('title')
{!! Auth::guard('employer')->user()->name !!} | Dashboard
@stop

@section('styles')
<link rel="stylesheet" href="{{ asset('/css/employer/dashboard.css') }}">
@stop

@section('nav')
<div class="col-auto">
    <span>Admin: {{ Auth::guard('employer')->user()->name }}</span>
</div>
<div class="col-auto">|</div>
<div class="col-auto">
    <a href="#">Menu</a>
</div>
<div class="col-auto">|</div>
<div class="col-auto">
    <a href="#">Printer</a>
</div>
<div class="col-auto">|</div>
<div class="col-auto">
    <a href="#">Tablets</a>
</div>
<div class="col-auto">|</div>
<div class="col-auto">
    <a href="#">Employees</a>
</div>
<div class="col-auto">|</div>
<div class="col-auto">
    <a href="#">Tables</a>
</div>
<div class="col-auto">|</div>
<div class="col-auto">
    <a href="#"onclick="event.preventDefault();document.getElementById('logout-form').submit();">
        Logout
    </a>
</div>
<form id="logout-form" action="{{ route('employer.logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
</form>
@endsection

@section('content')

@stop