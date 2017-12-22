@extends('layouts.app')

@section('title', 'Admin | Dashboard')

@section('styles')
<link rel="stylesheet" href="{{ asset('/css/admin/dashboard.css') }}">
@stop

@section('nav')
    @include('admin._nav')
@endsection

@section('content')
    @include('admin._search')
    @include('admin._table')
@stop

@section('scripts')
<script src="{{ asset('/js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('/js/admin/dashboard.js') }}"></script>
@stop