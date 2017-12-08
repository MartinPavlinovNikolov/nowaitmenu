@extends('layouts.app')

@section('title')
Admin-Dashboard
@stop

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
            <a href="{{ route('admin.settings') }}">Settings</a>
        </div>
        <div>|</div>
        <div class="col">
            <a href="#"onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                Logout
            </a>
        </div>
    </div>
</div>
<form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
</form>
@endsection

@section('content')
@if(session()->has('success'))
<h2>{{ session('success') }}</h2>
@endif

<!-- debuging purpose -->
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        @component('components.who')
        @endcomponent
    </div>
</div>
@if(count($employers) > 0)
<table class="table-md table-striped table-bordered table-hover">
    <thead class="table-info">
        <tr>
            <th>ID</th>
            <th>Company name</th>
            <th>E-mail</th>
            <th>Date created</th>
            <th>Employees</th>
            <th>Status</th>
            <th>Last Login</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($employers as $employer)
        <tr>
            <th scope="row">{{ ($employer->id) }}</th>
            <td>{{ ($employer->name) }}</td>
            <td>{{ ($employer->email) }}</td>
            <td>{{ ($employer->created_at) }}</td>
            <td>
                @if($employer->status == 1)
                active
                @else
                disabled
                @endif
            </td>
            <td>
                <div>
                    <div class="btn btn-danger btn-sm btn-employer" onclick="event.preventDefault();">
                        View({{ count($employer->employees) }})
                    </div>
                    <div class='table-employers' style="display: none;position: absolute;top: 30vh;left: 50%;width: 30rem;height: 50vh;transform: translateX(-50%);margin: 0 auto;background-color: gray;overflow-y: scroll">
                        <div class="text-right">
                        <button class="btn btn-danger btn-sm close">x</button>
                        </div>
                        <table class="table-md table-striped table-bordered table-hover" style="width: 80%;margin: 0 auto">
                            <thead class="table-info">
                                <tr>
                                    <td>Name</td>
                                    <td>Actions</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($employer->employees as $employee)
                                <tr>
                                    <td>{{ $employee->name }}</td>
                                    <td>
                                        <div class="btn btn-danger btn-sm">
                                            Login
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </td>
            <td>{{ $employer->last_login }}</td>
            <td>actions</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif
@stop