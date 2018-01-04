@extends('layouts.app')

@section('title')
{!! Auth::guard('employer')->user()->name !!} | Employees
@stop

@section('styles')
<link rel="stylesheet" href="{{ asset('/css/employer/dashboard.css') }}">
@stop

@section('nav')
@include('employer._nav')
@endsection

@section('content')
@include('employer.employees._content')
@stop

@section('scripts')
<script src="{{ asset('/js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('/js/employer/dashboard.js') }}"></script>
@stop